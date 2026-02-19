// Header.jsx
// Props:
//   title       - window title
//   onClose     - ✕ handler
//   onMinimize  - minimize handler  
//   onMaximize  - toggle maximize
//   onNewTab    - open section in new tab
//   onRefresh   - refresh/reload
//   viewMode    - "grid" | "list"
//   onViewToggle - toggle view mode

const Header = ({ title = "My PC", onClose, onMinimize, onMaximize, onRefresh, viewMode = "grid", onViewToggle }) => {

  const winBtn = (label, action, hoverColor = "#3a3a3a") => (
    <button
      onClick={action}
      style={{
        width: "32px", height: "32px",
        display: "flex", alignItems: "center", justifyContent: "center",
        border: "none", background: "transparent", cursor: "pointer",
        borderRadius: "5px", fontSize: "13px", color: "#aaa",
        transition: "background 0.15s, color 0.15s",
        fontFamily: "monospace",
      }}
      onMouseEnter={(e) => { e.currentTarget.style.background = hoverColor; e.currentTarget.style.color = "#fff"; }}
      onMouseLeave={(e) => { e.currentTarget.style.background = "transparent"; e.currentTarget.style.color = "#aaa"; }}
    >
      {label}
    </button>
  );

  const toolBtn = (icon, label, action) => (
    <button
      key={label}
      onClick={action}
      title={label}
      style={{
        display: "flex", alignItems: "center", gap: "5px",
        padding: "0 10px", height: "28px",
        border: "none", background: "transparent", cursor: "pointer",
        borderRadius: "5px", color: "#999", fontSize: "12px",
        fontFamily: "'Courier New', monospace", letterSpacing: "0.02em",
        transition: "background 0.12s, color 0.12s",
        whiteSpace: "nowrap",
      }}
      onMouseEnter={(e) => { e.currentTarget.style.background = "#2e2e2e"; e.currentTarget.style.color = "#eee"; }}
      onMouseLeave={(e) => { e.currentTarget.style.background = "transparent"; e.currentTarget.style.color = "#999"; }}
    >
      <span style={{ fontSize: "14px" }}>{icon}</span>
      <span>{label}</span>
    </button>
  );

  return (
    <div style={{ background: "#1e1e1e", borderBottom: "1px solid #2a2a2a", borderRadius: "12px 12px 0 0", overflow: "hidden", userSelect: "none" }}>

      {/* Title bar */}
      <div style={{
        display: "flex", alignItems: "center", justifyContent: "space-between",
        padding: "0 12px", height: "40px", borderBottom: "1px solid #2a2a2a",
      }}>
        <div style={{ display: "flex", alignItems: "center", gap: "8px" }}>
          <span style={{ fontSize: "15px" }}>🖥</span>
          <span style={{ color: "#ccc", fontSize: "13px", fontFamily: "'Courier New', monospace", letterSpacing: "0.03em" }}>
            {title}
          </span>
        </div>
        <div style={{ display: "flex", gap: "2px" }}>
          {winBtn("─", onMinimize)}
          {winBtn("□", onMaximize)}
          {winBtn("✕", onClose, "#c0392b")}
        </div>
      </div>

      {/* Toolbar */}
      <div style={{
        display: "flex", alignItems: "center",
        padding: "6px 10px", gap: "2px", height: "44px",
        borderBottom: "1px solid #2a2a2a",
      }}>
        {/* Left: useful actions */}
        {toolBtn("＋", "New Folder", () => alert("New Folder — wire to your state"))}
        
        <div style={{ width: "1px", height: "20px", background: "#333", margin: "0 4px" }} />

        {toolBtn("↺", "Refresh", onRefresh)}
        {toolBtn("⤢", "Full Screen", onMaximize)}

        <div style={{ flex: 1 }} />

        {/* Right: view toggle + sort */}
        {toolBtn("↕", "Sort A→Z", () => {})}

        <button
          onClick={onViewToggle}
          title={viewMode === "grid" ? "Switch to List" : "Switch to Grid"}
          style={{
            display: "flex", alignItems: "center", gap: "5px",
            padding: "0 10px", height: "28px",
            border: "none", cursor: "pointer", borderRadius: "5px",
            background: "#2e2e2e", color: "#eee", fontSize: "12px",
            fontFamily: "'Courier New', monospace", letterSpacing: "0.02em",
            transition: "background 0.12s",
          }}
          onMouseEnter={(e) => { e.currentTarget.style.background = "#3a3a3a"; }}
          onMouseLeave={(e) => { e.currentTarget.style.background = "#2e2e2e"; }}
        >
          <span style={{ fontSize: "14px" }}>{viewMode === "grid" ? "☰" : "⊞"}</span>
          <span>{viewMode === "grid" ? "List" : "Grid"}</span>
        </button>
      </div>
    </div>
  );
};

export default Header;