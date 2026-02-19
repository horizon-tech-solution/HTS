import { useState, useRef, useEffect } from "react";
import Header from "./Header";
import Nav from "./Nav";
import FolderIcon from "./FolderIcon";
import About    from "../pages/About";
import Services from "../pages/Services";
import Contact  from "../pages/Contact";
import Careers  from "../pages/Careers";
import Projects from "../pages/Projects";

// ─── Sections ──────────────────────────────────────────────────────────────────
export const SECTIONS = [
  { id: "services", label: "Services",  color: "#60a5fa", desc: "What we build",   component: <Services /> },
  { id: "about",    label: "About Us",  color: "#a78bfa", desc: "Our story",       component: <About />    },
  { id: "projects", label: "Projects",  color: "#34d399", desc: "Our work",        component: <Projects /> },
  { id: "contact",  label: "Contact",   color: "#fb923c", desc: "Get in touch",    component: <Contact />  },
  { id: "careers",  label: "Careers",   color: "#fbbf24", desc: "Join us",         component: <Careers />  },
];

// ─── URL helpers ───────────────────────────────────────────────────────────────
const setUrlParam = (key, value) => {
  const url = new URL(window.location.href);
  if (value) url.searchParams.set(key, value);
  else        url.searchParams.delete(key);
  window.history.replaceState({}, "", url.toString());
};
const getUrlParam = (key) => new URL(window.location.href).searchParams.get(key);

// ─── Hook: detect mobile ───────────────────────────────────────────────────────
const useIsMobile = () => {
  const [isMobile, setIsMobile] = useState(() => window.innerWidth < 640);
  useEffect(() => {
    const handler = () => setIsMobile(window.innerWidth < 640);
    window.addEventListener("resize", handler);
    return () => window.removeEventListener("resize", handler);
  }, []);
  return isMobile;
};

// ─── MyPC ──────────────────────────────────────────────────────────────────────
const MyPC = ({ onClose }) => {
  const isMobile = useIsMobile();

  const initFolder = getUrlParam("folder");
  const initPath   = initFolder
    ? ["HTS", SECTIONS.find((s) => s.id === initFolder)?.label ?? initFolder]
    : ["HTS"];

  const [path,        setPath]        = useState(initPath);
  const [pathHistory, setPathHistory] = useState([initPath]);
  const [histIdx,     setHistIdx]     = useState(0);
  const [selected,    setSelected]    = useState(null);
  const [maximized,   setMaximized]   = useState(false);
  const [viewMode,    setViewMode]    = useState("grid");
  const [search,      setSearch]      = useState("");
  const [sidebarOpen, setSidebarOpen] = useState(false);

  const winRef   = useRef(null);
  const dragging = useRef(null);

  const isRoot         = path.length === 1;
  const currentSection = !isRoot ? SECTIONS.find((s) => s.label === path[path.length - 1]) : null;
  const hasComponent   = currentSection?.component != null;

  useEffect(() => {
    setUrlParam("window", "mypc");
    setUrlParam("folder", currentSection?.id ?? "");
  }, [path, currentSection]);

  // ── Window drag ──
  const handleTitleMouseDown = (e) => {
    if (maximized || isMobile) return;
    const rect = winRef.current.getBoundingClientRect();
    dragging.current = { ox: e.clientX - rect.left, oy: e.clientY - rect.top };
    const onMove = (ev) => {
      if (!dragging.current || !winRef.current) return;
      const nx = Math.max(0, Math.min(window.innerWidth  - rect.width,  ev.clientX - dragging.current.ox));
      const ny = Math.max(0, Math.min(window.innerHeight - rect.height, ev.clientY - dragging.current.oy));
      winRef.current.style.left      = `${nx}px`;
      winRef.current.style.top       = `${ny}px`;
      winRef.current.style.transform = "none";
    };
    const onUp = () => { dragging.current = null; window.removeEventListener("mousemove", onMove); window.removeEventListener("mouseup", onUp); };
    window.addEventListener("mousemove", onMove);
    window.addEventListener("mouseup", onUp);
  };

  // ── Navigation ──
  const navigate = (newPath) => {
    const next = [...pathHistory.slice(0, histIdx + 1), newPath];
    setPathHistory(next); setHistIdx(next.length - 1);
    setPath(newPath); setSelected(null); setSearch("");
    setSidebarOpen(false);
  };
  const goBack      = () => { if (histIdx > 0) { const ni = histIdx - 1; setHistIdx(ni); setPath(pathHistory[ni]); setSelected(null); setSearch(""); } };
  const goForward   = () => { if (histIdx < pathHistory.length - 1) { const ni = histIdx + 1; setHistIdx(ni); setPath(pathHistory[ni]); setSelected(null); setSearch(""); } };
  const goUp        = () => { if (path.length > 1) navigate(path.slice(0, -1)); };
  const goToSegment = (i) => { if (i < path.length - 1) navigate(path.slice(0, i + 1)); };
  const openSection = (sec) => navigate(["HTS", sec.label]);
  const handleClose = () => { setUrlParam("window", ""); setUrlParam("folder", ""); onClose(); };

  const filtered = SECTIONS.filter((s) =>
    s.label.toLowerCase().includes(search.toLowerCase()) ||
    s.desc.toLowerCase().includes(search.toLowerCase())
  );

  // ─── Shared sidebar items ───────────────────────────────────────────────────
  const sidebarItems = [
    { label: "HTS", icon: "🖥", path: ["HTS"], color: "#4a90e2" },
    ...SECTIONS.map((s) => ({ label: s.label, icon: "📁", path: ["HTS", s.label], color: s.color })),
  ];

  const SidebarContent = () => (
    <>
      <p style={{ color: "#3a3a3a", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.12em", padding: "0 14px 10px", textTransform: "uppercase" }}>
        Quick Access
      </p>
      {sidebarItems.map((item, i) => {
        const isActive = path.join("/") === item.path.join("/");
        return (
          <div key={i} onClick={() => navigate(item.path)}
            style={{ display: "flex", alignItems: "center", gap: "8px", padding: "8px 14px", cursor: "pointer", background: isActive ? "#232323" : "transparent", borderLeft: isActive ? `3px solid ${item.color}` : "3px solid transparent", transition: "background 0.1s" }}
            onMouseEnter={(e) => { if (!isActive) e.currentTarget.style.background = "#1e1e1e"; }}
            onMouseLeave={(e) => { if (!isActive) e.currentTarget.style.background = "transparent"; }}
          >
            <span style={{ fontSize: "13px" }}>{item.icon}</span>
            <span style={{ color: isActive ? "#eee" : "#666", fontSize: "12px", fontFamily: "'Courier New', monospace" }}>{item.label}</span>
          </div>
        );
      })}
    </>
  );

  // ─── Window sizing ──────────────────────────────────────────────────────────
  const winStyle = isMobile
    ? { position: "fixed", inset: 0, width: "100dvw", height: "100dvh", borderRadius: 0, transform: "none", left: 0, top: 0 }
    : maximized
      ? { position: "fixed", inset: 0, width: "100vw", height: "100vh", borderRadius: 0, transform: "none", left: 0, top: 0 }
      : { position: "absolute", left: "50%", top: "50%", transform: "translate(-50%,-50%)", width: "min(960px, 94vw)", height: "min(620px, 90vh)", borderRadius: "12px" };

  return (
    <div style={{ position: "fixed", inset: 0, zIndex: 1000, pointerEvents: "none" }}>
      <div
        onClick={() => {
          if (isMobile && sidebarOpen) { setSidebarOpen(false); return; }
          handleClose();
        }}
        style={{ position: "absolute", inset: 0, background: isMobile ? "transparent" : "rgba(0,0,0,0.4)", pointerEvents: "all" }}
      />

      <div
        ref={winRef}
        onClick={(e) => e.stopPropagation()}
        style={{
          ...winStyle,
          background: "#1a1a1a",
          border: isMobile ? "none" : "1px solid #2e2e2e",
          boxShadow: isMobile ? "none" : "0 32px 90px rgba(0,0,0,0.65)",
          display: "flex", flexDirection: "column",
          overflow: "hidden", pointerEvents: "all",
          userSelect: isMobile ? "auto" : "none",
          touchAction: "pan-y",
        }}
      >
        {/* ── Title bar ── */}
        <div onMouseDown={handleTitleMouseDown} style={{ cursor: (maximized || isMobile) ? "default" : "move" }}>
          <Header
            title={isRoot ? "HTS" : currentSection?.label ?? "HTS"}
            onClose={handleClose}
            onMinimize={handleClose}
            onMaximize={() => !isMobile && setMaximized((m) => !m)}
            onRefresh={() => { setSearch(""); setSelected(null); }}
            viewMode={viewMode}
            onViewToggle={() => setViewMode((v) => v === "grid" ? "list" : "grid")}
          />
        </div>

        {/* ── Nav bar ── */}
        <div style={{ display: "flex", alignItems: "center" }}>
          {isMobile && (
            <button
              onClick={() => setSidebarOpen((o) => !o)}
              style={{
                flexShrink: 0, background: "none", border: "none",
                color: sidebarOpen ? "#aaa" : "#555",
                fontSize: 18, lineHeight: 1, cursor: "pointer",
                padding: "0 10px", fontFamily: "monospace",
                WebkitTapHighlightColor: "transparent",
              }}
            >
              ☰
            </button>
          )}
          <div style={{ flex: 1 }}>
            <Nav
              path={path}
              canBack={histIdx > 0}
              canForward={histIdx < pathHistory.length - 1}
              onBack={goBack} onForward={goForward} onUp={goUp}
              onSegment={goToSegment} searchVal={search} onSearch={setSearch}
            />
          </div>
        </div>

        {/* ── Body ── */}
        <div style={{ display: "flex", flex: 1, overflow: "hidden", position: "relative" }}>

          {/* ── Sidebar ── */}
          {!isMobile ? (
            <div style={{ width: "180px", flexShrink: 0, background: "#161616", borderRight: "1px solid #252525", padding: "14px 0", overflowY: "auto" }}>
              <SidebarContent />
            </div>
          ) : (
            <>
              {sidebarOpen && (
                <div onClick={() => setSidebarOpen(false)} style={{ position: "absolute", inset: 0, background: "rgba(0,0,0,0.45)", zIndex: 10 }} />
              )}
              <div style={{
                position: "absolute", top: 0, left: 0, bottom: 0,
                width: "200px", background: "#161616",
                borderRight: "1px solid #252525", padding: "14px 0",
                overflowY: "auto", zIndex: 11,
                transform: sidebarOpen ? "translateX(0)" : "translateX(-100%)",
                transition: "transform 0.22s cubic-bezier(0.22,1,0.36,1)",
                boxShadow: sidebarOpen ? "4px 0 24px rgba(0,0,0,0.5)" : "none",
              }}>
                <SidebarContent />
              </div>
            </>
          )}

          {/* ── Main pane ── */}
          <div
            style={{ flex: 1, overflow: "hidden", display: "flex", flexDirection: "column", touchAction: "pan-y" }}
            onClick={() => { setSelected(null); if (isMobile) setSidebarOpen(false); }}
          >
            {/* ROOT — single click opens folder on both desktop and mobile */}
            {isRoot && (
              <div style={{ flex: 1, overflowY: "auto", padding: isMobile ? "14px" : "20px" }}>
                <p style={{ color: "#e0e0e0", fontSize: "10px", fontFamily: "'Courier New', monospace", letterSpacing: "0.1em", marginBottom: "18px", textTransform: "uppercase" }}>
                  {search ? `Results for "${search}"` : `Sections (${SECTIONS.length})`}
                </p>
                {filtered.length === 0 ? (
                  <p style={{ color: "#444", fontSize: "13px", fontFamily: "'Courier New', monospace", textAlign: "center", marginTop: "60px" }}>No results.</p>
                ) : viewMode === "grid" ? (
                  <div style={{
                    display: "grid",
                    gridTemplateColumns: isMobile ? "repeat(3, 1fr)" : "repeat(auto-fill, minmax(120px, 1fr))",
                    gap: isMobile ? "6px" : "8px",
                  }}>
                    {filtered.map((sec) => (
                      <FolderIcon
                        key={sec.id}
                        color={sec.color}
                        size={isMobile ? 58 : 76}
                        label={sec.label}
                        selected={selected === sec.id}
                        onClick={(e) => { e.stopPropagation(); openSection(sec); }}
                      />
                    ))}
                  </div>
                ) : (
                  <div style={{ display: "flex", flexDirection: "column", gap: "2px" }}>
                    {filtered.map((sec) => (
                      <div
                        key={sec.id}
                        onClick={(e) => { e.stopPropagation(); openSection(sec); }}
                        style={{
                          display: "flex", alignItems: "center", gap: "12px",
                          padding: isMobile ? "11px 12px" : "8px 12px",
                          borderRadius: "6px",
                          background: "transparent", border: "1px solid transparent",
                          cursor: "pointer", transition: "background 0.1s",
                          WebkitTapHighlightColor: "transparent",
                        }}
                        onMouseEnter={(e) => { e.currentTarget.style.background = "#222"; }}
                        onMouseLeave={(e) => { e.currentTarget.style.background = "transparent"; }}
                      >
                        <span style={{ fontSize: "20px" }}>📁</span>
                        <div style={{ width: "10px", height: "10px", borderRadius: "2px", background: sec.color, flexShrink: 0 }} />
                        <span style={{ color: "#ccc", fontSize: "13px", fontFamily: "'Courier New', monospace", flex: 1 }}>{sec.label}</span>
                        <span style={{ color: "#444", fontSize: "11px", fontFamily: "'Courier New', monospace" }}>{sec.desc}</span>
                      </div>
                    ))}
                  </div>
                )}
              </div>
            )}

            {/* INSIDE FOLDER with component */}
            {!isRoot && hasComponent && (
              <div style={{ flex: 1, overflowY: "auto", WebkitOverflowScrolling: "touch", touchAction: "pan-y", display: "flex", flexDirection: "column" }}>
                {currentSection.component}
              </div>
            )}

            {/* INSIDE FOLDER — no component yet */}
            {!isRoot && !hasComponent && (
              <div style={{ display: "flex", flexDirection: "column", alignItems: "center", justifyContent: "center", height: "100%", gap: "14px", padding: "40px" }}>
                <FolderIcon color={currentSection?.color ?? "#888"} size={isMobile ? 72 : 90} label="" onClick={() => {}} />
                <p style={{ color: "#555", fontSize: "14px", fontFamily: "'Courier New', monospace" }}>{currentSection?.label}</p>
                <p style={{ color: "#333", fontSize: "12px", fontFamily: "'Courier New', monospace" }}>{currentSection?.desc}</p>
                <p style={{ color: "#2a2a2a", fontSize: "11px", fontFamily: "'Courier New', monospace", marginTop: "8px" }}>coming soon</p>
              </div>
            )}
          </div>

          {/* Detail panel — desktop only */}
          {!isMobile && isRoot && selected && (() => {
            const sec = SECTIONS.find((s) => s.id === selected);
            if (!sec) return null;
            return (
              <div style={{ width: "185px", flexShrink: 0, background: "#161616", borderLeft: "1px solid #252525", padding: "20px 14px", display: "flex", flexDirection: "column", gap: "12px" }}>
                <div style={{ display: "flex", justifyContent: "center" }}>
                  <FolderIcon color={sec.color} size={66} label="" onClick={() => {}} />
                </div>
                <p style={{ color: "#ddd", fontSize: "13px", fontFamily: "'Courier New', monospace", textAlign: "center" }}>{sec.label}</p>
                <div style={{ borderTop: "1px solid #252525", paddingTop: "12px", display: "flex", flexDirection: "column", gap: "10px" }}>
                  {[["Type", "Folder"], ["Description", sec.desc], ["Status", sec.component ? "Ready" : "Coming soon"]].map(([k, v]) => (
                    <div key={k}>
                      <p style={{ color: "#3a3a3a", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.1em", marginBottom: "3px" }}>{k.toUpperCase()}</p>
                      <p style={{ color: "#888", fontSize: "11px", fontFamily: "'Courier New', monospace" }}>{v}</p>
                    </div>
                  ))}
                </div>
                {sec.component && (
                  <button onClick={() => openSection(sec)}
                    style={{ marginTop: "auto", padding: "8px", border: "1px solid #2e2e2e", background: "#202020", color: "#bbb", borderRadius: "6px", fontSize: "12px", fontFamily: "'Courier New', monospace", cursor: "pointer", transition: "all 0.12s" }}
                    onMouseEnter={(e) => { e.currentTarget.style.background = "#2a2a2a"; e.currentTarget.style.color = "#fff"; }}
                    onMouseLeave={(e) => { e.currentTarget.style.background = "#202020"; e.currentTarget.style.color = "#bbb"; }}
                  >
                    Open →
                  </button>
                )}
              </div>
            );
          })()}
        </div>

        {/* Status bar */}
        <div style={{ height: "30px", background: "#141414", borderTop: "1px solid #252525", display: "flex", alignItems: "center", justifyContent: "space-between", padding: "0 16px", flexShrink: 0 }}>
          <span style={{ color: "#3a3a3a", fontSize: "11px", fontFamily: "'Courier New', monospace" }}>
            {isRoot ? `${filtered.length} item${filtered.length !== 1 ? "s" : ""}` : currentSection?.label}
          </span>
          <span style={{ color: "#2e2e2e", fontSize: "11px", fontFamily: "'Courier New', monospace" }}>
            {viewMode === "grid" ? "grid view" : "list view"}
          </span>
        </div>
      </div>
    </div>
  );
};

export default MyPC;