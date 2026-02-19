// FolderIcon.jsx
const FolderIcon = ({ color = "#60a5fa", size = 80, label = "Folder", onClick, onDoubleClick, selected }) => {
  const patternId = `pat-${(color + label).replace(/[^a-zA-Z0-9]/g, "")}`;

  return (
    <div
      onClick={onClick}
      onDoubleClick={onDoubleClick}
      style={{
        display:        "flex",
        flexDirection:  "column",
        alignItems:     "center",
        gap:            "8px",
        cursor:         "default",
        userSelect:     "none",
        padding:        "8px 6px",
        borderRadius:   "8px",
        background:     selected ? "rgba(74,144,226,0.18)" : "transparent",
        border:         selected ? "1px solid rgba(74,144,226,0.4)" : "1px solid transparent",
        transition:     "background 0.12s",
        width:          size + 20,
      }}
    >
      <svg width={size} height={size * 0.75} viewBox="0 0 120 90" fill="none" xmlns="http://www.w3.org/2000/svg">
        {/* Tab */}
        <path
          d="M15 15C15 12.24 17.24 10 20 10H42L52 22H105C107.76 22 110 24.24 110 27V30H15V15Z"
          fill={color}
          stroke="rgba(0,0,0,0.2)" strokeWidth="1.2"
        />
        {/* Body */}
        <path
          d="M15 27H110C112.76 27 115 29.24 115 32V80C115 82.76 112.76 85 110 85H20C17.24 85 15 82.76 15 80V27Z"
          fill={color}
          stroke="rgba(0,0,0,0.2)" strokeWidth="1.2"
        />
        {/* Shine */}
        <path d="M15 27H115V40C115 40 75 45 15 38V27Z" fill="rgba(255,255,255,0.18)" />
        {/* Texture */}
        <defs>
          <pattern id={patternId} x="0" y="0" width="8" height="8" patternUnits="userSpaceOnUse">
            <path d="M0 8L8 0M-2 2L2 -2M6 10L10 6" stroke="#000" strokeWidth="0.5" opacity="0.08" />
          </pattern>
          <clipPath id={`cl-${patternId}`}>
            <path d="M15 27H110C112.76 27 115 29.24 115 32V80C115 82.76 112.76 85 110 85H20C17.24 85 15 82.76 15 80V27Z" />
          </clipPath>
        </defs>
        <rect x="15" y="27" width="100" height="58" fill={`url(#${patternId})`} clipPath={`url(#cl-${patternId})`} />
      </svg>

      <span style={{
        fontSize:      "12px",
        fontFamily:    "'Courier New', monospace",
        color:         "#e8e8e8",          // light so it's visible on dark bg
        letterSpacing: "0.02em",
        textAlign:     "center",
        lineHeight:    1.3,
        maxWidth:      size + 10,
        wordBreak:     "break-word",
      }}>
        {label}
      </span>
    </div>
  );
};

export default FolderIcon;