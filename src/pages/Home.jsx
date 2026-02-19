import { useState, useRef, useEffect, useCallback } from "react";
import PcIcon from "../components/PcIcon";
import TrashIcon from "../components/TrashIcon";
import MyPC from "../components/MyPc";

// ─── Config ────────────────────────────────────────────────────────────────────
const STORAGE_KEY = "desktop_v5";
const ICON_W      = 90;
const ICON_H      = 110;
const GAP         = 28;
const FOOTER_H    = 48;

const SOCIAL = [
  { label: "instagram", href: "https://instagram.com" },
  { label: "linkedin",  href: "https://linkedin.com"  },
  { label: "github",    href: "https://github.com"    },
];

// ─── URL helpers ───────────────────────────────────────────────────────────────
const getUrlParam = (key) => new URL(window.location.href).searchParams.get(key);

// ─── Persistence ───────────────────────────────────────────────────────────────
const savePos = (pos) => {
  try { localStorage.setItem(STORAGE_KEY, JSON.stringify(pos)); } catch {}
};
const loadPos = () => {
  try { const r = localStorage.getItem(STORAGE_KEY); return r ? JSON.parse(r) : null; }
  catch { return null; }
};
const getDefaults = () => {
  const vw = window.innerWidth;
  const vh = window.innerHeight;
  const x0 = Math.round(vw * 0.05);
  const y0 = Math.round(vh * 0.09);
  return {
    pc:    { x: x0, y: y0 },
    trash: { x: x0, y: y0 + ICON_H + GAP + 10 },
  };
};
const getInitial = () => {
  const saved = loadPos();
  if (!saved) return getDefaults();
  const { pc, trash } = saved;
  const overlap = Math.abs(pc.x - trash.x) < ICON_W + GAP && Math.abs(pc.y - trash.y) < ICON_H + GAP;
  return overlap ? getDefaults() : saved;
};

// ─── Collision ─────────────────────────────────────────────────────────────────
const clamp = (x, y) => ({
  x: Math.max(0, Math.min(window.innerWidth  - ICON_W, x)),
  y: Math.max(0, Math.min(window.innerHeight - ICON_H - FOOTER_H, y)),
});
const separate = (aPos, bPos) => {
  const aCx = aPos.x + ICON_W / 2, aCy = aPos.y + ICON_H / 2;
  const bCx = bPos.x + ICON_W / 2, bCy = bPos.y + ICON_H / 2;
  const dx = bCx - aCx, dy = bCy - aCy;
  const overlapX = (ICON_W + GAP) - Math.abs(dx);
  const overlapY = (ICON_H + GAP) - Math.abs(dy);
  if (overlapX <= 0 || overlapY <= 0) return bPos;
  if (overlapX < overlapY) return clamp(bPos.x + (dx >= 0 ? overlapX : -overlapX), bPos.y);
  return clamp(bPos.x, bPos.y + (dy >= 0 ? overlapY : -overlapY));
};

// ─── Draggable hook ────────────────────────────────────────────────────────────
const useDraggable = () => {
  const [positions, setPositions] = useState(getInitial);
  const drag = useRef(null);

  const startDrag = useCallback((e, id) => {
    e.preventDefault();
    const pt   = e.touches ? e.touches[0] : e;
    const rect = e.currentTarget.getBoundingClientRect();
    drag.current = { id, ox: pt.clientX - rect.left, oy: pt.clientY - rect.top };
  }, []);

  useEffect(() => {
    const move = (cx, cy) => {
      if (!drag.current) return;
      const { id, ox, oy } = drag.current;
      const otherId = id === "pc" ? "trash" : "pc";
      setPositions((prev) => {
        const activePos = clamp(cx - ox, cy - oy);
        const otherPos  = separate(activePos, prev[otherId]);
        const next = { ...prev, [id]: activePos, [otherId]: otherPos };
        savePos(next);
        return next;
      });
    };
    const onMM = (e) => move(e.clientX, e.clientY);
    const onTM = (e) => { 
      if (!drag.current) return; // ← only block scroll when dragging an icon
      e.preventDefault(); 
      move(e.touches[0].clientX, e.touches[0].clientY); 
    };
    const onUp = () => { drag.current = null; };
    window.addEventListener("mousemove",  onMM);
    window.addEventListener("mouseup",    onUp);
    window.addEventListener("touchmove",  onTM, { passive: false });
    window.addEventListener("touchend",   onUp);
    return () => {
      window.removeEventListener("mousemove",  onMM);
      window.removeEventListener("mouseup",    onUp);
      window.removeEventListener("touchmove",  onTM);
      window.removeEventListener("touchend",   onUp);
    };
  }, []);

  return { positions, startDrag };
};

// ─── Home ──────────────────────────────────────────────────────────────────────
export default function Home() {
  const [selected, setSelected] = useState(null);
  const [time, setTime]         = useState(new Date());

  // Re-open window from URL on first load
  const [showPC, setShowPC] = useState(() => getUrlParam("window") === "mypc");

  const { positions, startDrag } = useDraggable();

  useEffect(() => {
    const t = setInterval(() => setTime(new Date()), 1000);
    return () => clearInterval(t);
  }, []);

  const fmtTime = (d) => d.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
  const fmtDate = (d) => d.toLocaleDateString([], { weekday: "short", month: "short", day: "numeric" });

  const openPC = () => setShowPC(true);
  const closePC = () => {
    // URL cleanup is handled inside MyPC.jsx onClose
    setShowPC(false);
  };

  const icons = [
    { id: "pc",    node: <PcIcon    label="Horizon Tech Solution"  onClick={openPC} /> },
    { id: "trash", node: <TrashIcon label="Recycle Bin" isEmpty onClick={() => {}} /> },
  ];

  return (
    <>
      <style>{`
        @keyframes bgDrift {
          0%   { background-position: 0% 50%;   filter: hue-rotate(0deg); }
          33%  { background-position: 100% 20%; filter: hue-rotate(18deg); }
          66%  { background-position: 60% 100%; filter: hue-rotate(-10deg); }
          100% { background-position: 0% 50%;   filter: hue-rotate(0deg); }
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body, #root { width: 100%; height: 100%; overflow: hidden; touch-action: none; }
      `}</style>

      {/* Animated bg */}
      <div style={{
        position: "fixed", inset: 0, zIndex: 0, pointerEvents: "none",
        backgroundImage: `
          radial-gradient(ellipse at 18% 28%,  rgba(126, 166, 226, 0.92) 0%, transparent 52%),
          radial-gradient(ellipse at 82% 72%,  rgba(235, 170, 72, 0.92) 0%, transparent 52%),
          radial-gradient(ellipse at 52% 2%,   rgba(88, 240, 161, 0.78) 0%, transparent 48%),
          radial-gradient(ellipse at 5%  92%,  hsla(175, 61%, 46%, 0.78) 0%, transparent 48%),
          radial-gradient(ellipse at 95% 8%,   rgba(82, 79, 247, 0.72) 0%, transparent 46%),
          linear-gradient(140deg, #c3dff8 0%, #f5e1b8 38%, #a9f0cb 68%, #e39ffc 100%)
        `,
        backgroundSize: "380% 380%",
        animation: "bgDrift 16s ease infinite",
      }} />

      {/* Desktop */}
      <div
        onClick={() => setSelected(null)}
        style={{ width: "100vw", height: "100vh", overflow: "hidden", position: "relative" }}
      >
        {/* Company name — centered on desktop */}
        <div style={{
          position:       "absolute",
          top:            "50%",
          left:           "50%",
          transform:      "translate(-50%, -50%)",
          textAlign:      "center",
          pointerEvents:  "none",
          zIndex:         1,
        }}>
          <p style={{
            fontFamily:    "'Courier New', monospace",
            fontSize:      "clamp(11px, 1.4vw, 14px)",
            letterSpacing: "0.28em",
            textTransform: "uppercase",
            color:         "rgba(0, 0, 0, 0.22)",
            marginBottom:  "10px",
          }}>
            Welcome to
          </p>
          <h1 style={{
            fontFamily:    "'Courier New', monospace",
            fontSize:      "clamp(22px, 4vw, 52px)",
            fontWeight:    "normal",
            letterSpacing: "0.18em",
            textTransform: "uppercase",
            color:         "rgba(0, 0, 0, 0.13)",
            lineHeight:    1.2,
            margin:        0,
          }}>
            Horizon<br />Tech Solution
          </h1>
        </div>
        
        {icons.map(({ id, node }) => {
          const isSel = selected === id;
          return (
            <div
              key={id}
              onMouseDown={(e) => { e.stopPropagation(); startDrag(e, id); setSelected(id); }}
              onTouchStart={(e) => { e.stopPropagation(); startDrag(e, id); setSelected(id); }}
              onClick={(e) => {
                e.stopPropagation();
                setSelected(id);
                if (id === "pc") openPC();
              }}
              style={{
                position: "absolute",
                left:  positions[id]?.x ?? 24,
                top:   positions[id]?.y ?? 80,
                width: `${ICON_W}px`, height: `${ICON_H}px`,
                zIndex: isSel ? 30 : 10,
                cursor: "grab",
                display: "flex", flexDirection: "column",
                alignItems: "center", justifyContent: "center",
                padding: "8px 4px 6px", borderRadius: "10px",
                background:  isSel ? "rgba(74,144,226,0.1)"        : "transparent",
                border:      isSel ? "1px solid rgba(74,144,226,0.28)" : "1px solid transparent",
                transition:  "background 0.15s, border-color 0.15s",
                WebkitTapHighlightColor: "transparent",
                touchAction: "none",
              }}
            >
              {node}
            </div>
          );
        })}

        {/* MyPC popup */}
        {showPC && <MyPC onClose={closePC} />}

        {/* Footer */}
        <footer
          onClick={(e) => e.stopPropagation()}
          style={{
            position: "fixed", bottom: 0, left: 0, right: 0,
            height: `${FOOTER_H}px`,
            display: "flex", alignItems: "center", justifyContent: "space-between",
            padding: "0 clamp(16px, 4vw, 48px)", zIndex: 100,
          }}
        >
          <div style={{ flex: 1 }} />
          <nav style={{ flex: 1, display: "flex", alignItems: "center", justifyContent: "center" }}>
            {SOCIAL.map(({ label, href }, i) => (
              <span key={label} style={{ display: "flex", alignItems: "center" }}>
                <a
                  href={href} target="_blank" rel="noopener noreferrer"
                  style={{
                    color: "#2c2c2c", fontSize: "clamp(11px,1.3vw,13px)",
                    letterSpacing: "0.07em", textDecoration: "none",
                    padding: "0 clamp(7px,1.4vw,16px)",
                    fontFamily: "'Courier New', monospace", transition: "color 0.2s",
                  }}
                  onMouseEnter={(e) => (e.currentTarget.style.color = "#111")}
                  onMouseLeave={(e) => (e.currentTarget.style.color = "#999")}
                >
                  {label}
                </a>
                {i < SOCIAL.length - 1 && (
                  <span style={{ color: "#1b1b1b", fontFamily: "'Courier New', monospace", fontSize: "clamp(11px,1.3vw,13px)" }}>/</span>
                )}
              </span>
            ))}
          </nav>
          <div style={{ flex: 1, textAlign: "right" }}>
            <span style={{ color: "#222222", fontSize: "clamp(11px,1.2vw,13px)", fontFamily: "'Courier New', monospace", letterSpacing: "0.05em" }}>
              {fmtTime(time)}
            </span>
            <span style={{ color: "#070707", fontSize: "clamp(10px,1vw,11px)", fontFamily: "'Courier New', monospace", marginLeft: "7px" }}>
              {fmtDate(time)}
            </span>
          </div>
        </footer>
      </div>
    </>
  );
}