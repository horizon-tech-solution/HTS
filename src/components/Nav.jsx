// Nav.jsx
// Props:
//   path       - current path array e.g. ["My PC"] or ["My PC", "Services"]
//   canBack    - bool
//   canForward - bool
//   onBack     - handler
//   onForward  - handler
//   onUp       - handler
//   onSegment  - called with (index) when breadcrumb segment clicked
//   searchVal  - search input value
//   onSearch   - search change handler

const Nav = ({ path = ["My PC"], canBack, canForward, onBack, onForward, onUp, onSegment, searchVal = "", onSearch }) => {

  const arrowBtn = (icon, action, enabled) => (
    <button
      onClick={enabled ? action : undefined}
      style={{
        width: "30px", height: "30px",
        display: "flex", alignItems: "center", justifyContent: "center",
        border: "none", background: "transparent",
        cursor: enabled ? "pointer" : "default",
        borderRadius: "5px", fontSize: "16px",
        color: enabled ? "#bbb" : "#444",
        transition: "background 0.12s, color 0.12s",
        flexShrink: 0,
      }}
      onMouseEnter={(e) => { if (enabled) { e.currentTarget.style.background = "#2e2e2e"; e.currentTarget.style.color = "#fff"; }}}
      onMouseLeave={(e) => { e.currentTarget.style.background = "transparent"; e.currentTarget.style.color = enabled ? "#bbb" : "#444"; }}
    >
      {icon}
    </button>
  );

  return (
    <div style={{
      display: "flex", alignItems: "center", gap: "6px",
      padding: "0 10px", background: "#181818",
      borderBottom: "1px solid #2a2a2a", height: "44px",
    }}>
      {/* Navigation arrows */}
      {arrowBtn("←", onBack,    canBack)}
      {arrowBtn("→", onForward, canForward)}
      {arrowBtn("↑", onUp,      path.length > 1)}

      {/* Breadcrumb bar */}
      <div style={{
        flex: 1, display: "flex", alignItems: "center", gap: "4px",
        background: "#111", border: "1px solid #333", borderRadius: "6px",
        padding: "0 12px", height: "32px", overflow: "hidden",
      }}>
        <span style={{ fontSize: "13px", flexShrink: 0 }}>🖥</span>
        {path.map((seg, i) => (
          <span key={i} style={{ display: "flex", alignItems: "center", gap: "2px", flexShrink: 0 }}>
            <span
              onClick={() => onSegment && onSegment(i)}
              style={{
                color: i === path.length - 1 ? "#e0e0e0" : "#777",
                fontSize: "12px",
                fontFamily: "'Courier New', monospace",
                letterSpacing: "0.03em",
                cursor: i < path.length - 1 ? "pointer" : "default",
                padding: "2px 4px", borderRadius: "3px",
                transition: "background 0.1s, color 0.1s",
                whiteSpace: "nowrap",
              }}
              onMouseEnter={(e) => { if (i < path.length - 1) { e.currentTarget.style.background = "#252525"; e.currentTarget.style.color = "#fff"; }}}
              onMouseLeave={(e) => { e.currentTarget.style.background = "transparent"; e.currentTarget.style.color = i === path.length - 1 ? "#e0e0e0" : "#777"; }}
            >
              {seg}
            </span>
            {i < path.length - 1 && (
              <span style={{ color: "#444", fontSize: "12px", fontFamily: "monospace" }}>›</span>
            )}
          </span>
        ))}
      </div>

      {/* Refresh */}
      <button
        onClick={() => window.location.reload()}
        style={{
          width: "30px", height: "30px",
          display: "flex", alignItems: "center", justifyContent: "center",
          border: "none", background: "transparent", cursor: "pointer",
          borderRadius: "5px", fontSize: "15px", color: "#777",
          transition: "background 0.12s, color 0.12s", flexShrink: 0,
        }}
        onMouseEnter={(e) => { e.currentTarget.style.background = "#2e2e2e"; e.currentTarget.style.color = "#fff"; }}
        onMouseLeave={(e) => { e.currentTarget.style.background = "transparent"; e.currentTarget.style.color = "#777"; }}
      >
        ↻
      </button>

      {/* Search */}
      <div style={{
        display: "flex", alignItems: "center", gap: "6px",
        background: "#111", border: "1px solid #333", borderRadius: "6px",
        padding: "0 10px", height: "32px",
        width: "clamp(90px, 16%, 200px)", flexShrink: 0,
      }}>
        <span style={{ color: "#555", fontSize: "13px", flexShrink: 0 }}>⌕</span>
        <input
          type="text"
          placeholder="Search"
          value={searchVal}
          onChange={(e) => onSearch && onSearch(e.target.value)}
          style={{
            background: "transparent", border: "none", outline: "none",
            color: "#ccc", fontSize: "12px",
            fontFamily: "'Courier New', monospace", width: "100%",
          }}
        />
      </div>
    </div>
  );
};

export default Nav;