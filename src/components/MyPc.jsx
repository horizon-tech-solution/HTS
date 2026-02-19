import { useState, useRef, useEffect } from "react";
import Header from "./Header";
import Nav from "./Nav";
import FolderIcon from "./FolderIcon";
import About    from "../pages/About";
import Services from "../pages/Services";
import Contact  from "../pages/Contact";
import Careers  from "../pages/Careers";

// ─── Sections ──────────────────────────────────────────────────────────────────
export const SECTIONS = [
  { id: "services", label: "Services",  color: "#60a5fa", desc: "What we build",   component: <Services /> },
  { id: "about",    label: "About Us",  color: "#a78bfa", desc: "Our story",       component: <About />    },
  { id: "projects", label: "Projects",  color: "#34d399", desc: "Our work",        component: null         },
  { id: "contact",  label: "Contact",   color: "#fb923c", desc: "Get in touch",    component: <Contact />  },
  { id: "team",     label: "Our Team",  color: "#f472b6", desc: "Who we are",      component: null         },
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

// ─── MyPC ──────────────────────────────────────────────────────────────────────
const MyPC = ({ onClose }) => {
  const initFolder = getUrlParam("folder");
  const initPath   = initFolder
    ? ["My PC", SECTIONS.find((s) => s.id === initFolder)?.label ?? initFolder]
    : ["My PC"];

  const [path,        setPath]        = useState(initPath);
  const [pathHistory, setPathHistory] = useState([initPath]);
  const [histIdx,     setHistIdx]     = useState(0);
  const [selected,    setSelected]    = useState(null);
  const [maximized,   setMaximized]   = useState(false);
  const [viewMode,    setViewMode]    = useState("grid");
  const [search,      setSearch]      = useState("");

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
    if (maximized) return;
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
  };
  const goBack      = () => { if (histIdx > 0) { const ni = histIdx - 1; setHistIdx(ni); setPath(pathHistory[ni]); setSelected(null); setSearch(""); } };
  const goForward   = () => { if (histIdx < pathHistory.length - 1) { const ni = histIdx + 1; setHistIdx(ni); setPath(pathHistory[ni]); setSelected(null); setSearch(""); } };
  const goUp        = () => { if (path.length > 1) navigate(path.slice(0, -1)); };
  const goToSegment = (i) => { if (i < path.length - 1) navigate(path.slice(0, i + 1)); };
  const openSection = (sec) => navigate(["My PC", sec.label]);
  const handleClose = () => { setUrlParam("window", ""); setUrlParam("folder", ""); onClose(); };

  const filtered = SECTIONS.filter((s) =>
    s.label.toLowerCase().includes(search.toLowerCase()) ||
    s.desc.toLowerCase().includes(search.toLowerCase())
  );

  const winStyle = maximized
    ? { position: "fixed", inset: 0, width: "100vw", height: "100vh", borderRadius: 0, transform: "none", left: 0, top: 0 }
    : { position: "absolute", left: "50%", top: "50%", transform: "translate(-50%,-50%)", width: "min(960px, 94vw)", height: "min(620px, 90vh)", borderRadius: "12px" };

  return (
    <div style={{ position: "fixed", inset: 0, zIndex: 1000, pointerEvents: "none" }}>
      <div onClick={handleClose} style={{ position: "absolute", inset: 0, background: "rgba(0,0,0,0.4)", pointerEvents: "all" }} />

      <div
        ref={winRef}
        onClick={(e) => e.stopPropagation()}
        style={{
          ...winStyle,
          background: "#1a1a1a", border: "1px solid #2e2e2e",
          boxShadow: "0 32px 90px rgba(0,0,0,0.65)",
          display: "flex", flexDirection: "column",
          overflow: "hidden", pointerEvents: "all", userSelect: "none",
        }}
      >
        <div onMouseDown={handleTitleMouseDown} style={{ cursor: maximized ? "default" : "move" }}>
          <Header
            title={isRoot ? "My PC" : currentSection?.label ?? "My PC"}
            onClose={handleClose}
            onMinimize={handleClose}
            onMaximize={() => setMaximized((m) => !m)}
            onRefresh={() => { setSearch(""); setSelected(null); }}
            viewMode={viewMode}
            onViewToggle={() => setViewMode((v) => v === "grid" ? "list" : "grid")}
          />
        </div>

        <Nav
          path={path}
          canBack={histIdx > 0}
          canForward={histIdx < pathHistory.length - 1}
          onBack={goBack} onForward={goForward} onUp={goUp}
          onSegment={goToSegment} searchVal={search} onSearch={setSearch}
        />

        <div style={{ display: "flex", flex: 1, overflow: "hidden" }}>
          {/* Sidebar */}
          <div style={{ width: "180px", flexShrink: 0, background: "#161616", borderRight: "1px solid #252525", padding: "14px 0", overflowY: "auto" }}>
            <p style={{ color: "#3a3a3a", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.12em", padding: "0 14px 10px", textTransform: "uppercase" }}>
              Quick Access
            </p>
            {[
              { label: "My PC", icon: "🖥", path: ["My PC"], color: "#4a90e2" },
              ...SECTIONS.map((s) => ({ label: s.label, icon: "📁", path: ["My PC", s.label], color: s.color })),
            ].map((item, i) => {
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
          </div>

          {/* Main pane */}
          <div style={{ flex: 1, overflow: "hidden", display: "flex", flexDirection: "column" }} onClick={() => setSelected(null)}>

            {/* ROOT */}
            {isRoot && (
              <div style={{ flex: 1, overflowY: "auto", padding: "20px" }}>
                <p style={{ color: "#3a3a3a", fontSize: "10px", fontFamily: "'Courier New', monospace", letterSpacing: "0.1em", marginBottom: "18px", textTransform: "uppercase" }}>
                  {search ? `Results for "${search}"` : `Sections (${SECTIONS.length})`}
                </p>
                {filtered.length === 0 ? (
                  <p style={{ color: "#444", fontSize: "13px", fontFamily: "'Courier New', monospace", textAlign: "center", marginTop: "60px" }}>No results.</p>
                ) : viewMode === "grid" ? (
                  <div style={{ display: "grid", gridTemplateColumns: "repeat(auto-fill, minmax(120px, 1fr))", gap: "8px" }}>
                    {filtered.map((sec) => (
                      <FolderIcon key={sec.id} color={sec.color} size={76} label={sec.label}
                        selected={selected === sec.id}
                        onClick={(e) => { e.stopPropagation(); setSelected(sec.id); }}
                        onDoubleClick={() => openSection(sec)}
                      />
                    ))}
                  </div>
                ) : (
                  <div style={{ display: "flex", flexDirection: "column", gap: "2px" }}>
                    {filtered.map((sec) => (
                      <div key={sec.id}
                        onClick={(e) => { e.stopPropagation(); setSelected(sec.id); }}
                        onDoubleClick={() => openSection(sec)}
                        style={{ display: "flex", alignItems: "center", gap: "12px", padding: "8px 12px", borderRadius: "6px", background: selected === sec.id ? "rgba(74,144,226,0.15)" : "transparent", border: selected === sec.id ? "1px solid rgba(74,144,226,0.3)" : "1px solid transparent", cursor: "default", transition: "background 0.1s" }}
                        onMouseEnter={(e) => { if (selected !== sec.id) e.currentTarget.style.background = "#222"; }}
                        onMouseLeave={(e) => { if (selected !== sec.id) e.currentTarget.style.background = "transparent"; }}
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
              <div style={{ flex: 1, overflow: "hidden", display: "flex", flexDirection: "column" }}>
                {currentSection.component}
              </div>
            )}

            {/* INSIDE FOLDER — no component yet */}
            {!isRoot && !hasComponent && (
              <div style={{ display: "flex", flexDirection: "column", alignItems: "center", justifyContent: "center", height: "100%", gap: "14px", padding: "40px" }}>
                <FolderIcon color={currentSection?.color ?? "#888"} size={90} label="" />
                <p style={{ color: "#555", fontSize: "14px", fontFamily: "'Courier New', monospace" }}>{currentSection?.label}</p>
                <p style={{ color: "#333", fontSize: "12px", fontFamily: "'Courier New', monospace" }}>{currentSection?.desc}</p>
                <p style={{ color: "#2a2a2a", fontSize: "11px", fontFamily: "'Courier New', monospace", marginTop: "8px" }}>
                  coming soon
                </p>
              </div>
            )}
          </div>

          {/* Detail panel */}
          {isRoot && selected && (() => {
            const sec = SECTIONS.find((s) => s.id === selected);
            if (!sec) return null;
            return (
              <div style={{ width: "185px", flexShrink: 0, background: "#161616", borderLeft: "1px solid #252525", padding: "20px 14px", display: "flex", flexDirection: "column", gap: "12px" }}>
                <div style={{ display: "flex", justifyContent: "center" }}>
                  <FolderIcon color={sec.color} size={66} label="" />
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