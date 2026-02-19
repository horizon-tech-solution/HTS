import { useState } from "react";

// FileIcon.jsx — matches Windows/macOS document icon style:
// rounded rectangle body, top-right folded corner, 3 content lines centered

const FileIcon = ({ label = "file", size = 72, selected, onClick, color = "#a78bfa" }) => {
  const [hovered, setHovered] = useState(false);
  const active = hovered || selected;

  return (
    <div
      onClick={onClick}
      onMouseEnter={() => setHovered(true)}
      onMouseLeave={() => setHovered(false)}
      onTouchStart={() => setHovered(true)}
      onTouchEnd={() => setHovered(false)}
      style={{
        display:       "flex",
        flexDirection: "column",
        alignItems:    "center",
        gap:           "10px",
        cursor:        "default",
        userSelect:    "none",
        WebkitUserSelect: "none",
        padding:       "10px 8px",
        borderRadius:  "10px",
        background:    selected ? `${color}18` : active ? "rgba(255,255,255,0.04)" : "transparent",
        border:        selected ? `1px solid ${color}55` : "1px solid transparent",
        transition:    "background 0.15s, border-color 0.15s, transform 0.12s",
        transform:     active && !selected ? "scale(1.05)" : "scale(1)",
        minWidth:      "70px",
        WebkitTapHighlightColor: "transparent",
      }}
    >
      <svg
        width={size * 0.78}
        height={size}
        viewBox="0 0 56 72"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        {/* Main body — rounded rect with top-right corner clipped */}
        <path
          d="M4 6 C4 2.7 6.7 0 10 0 L36 0 L52 16 L52 66 C52 69.3 49.3 72 46 72 L10 72 C6.7 72 4 69.3 4 66 Z"
          fill={active ? "#2c2c2c" : "#242424"}
          style={{ transition: "fill 0.15s" }}
        />

        {/* Folded corner */}
        <path
          d="M36 0 L36 16 L52 16 Z"
          fill={active ? color : "#3a3a3a"}
          style={{ transition: "fill 0.2s" }}
        />

        {/* Stroke on whole icon */}
        <path
          d="M4 6 C4 2.7 6.7 0 10 0 L36 0 L52 16 L52 66 C52 69.3 49.3 72 46 72 L10 72 C6.7 72 4 69.3 4 66 Z"
          fill="none"
          stroke={active ? color : "#383838"}
          strokeWidth="1.5"
          style={{ transition: "stroke 0.2s" }}
        />

        {/* 3 content lines */}
        <rect x="11" y="34" width="34" height="3" rx="1.5"
          fill={active ? "#888" : "#4a4a4a"}
          style={{ transition: "fill 0.2s" }}
        />
        <rect x="11" y="43" width="28" height="3" rx="1.5"
          fill={active ? "#666" : "#3a3a3a"}
          style={{ transition: "fill 0.2s" }}
        />
        <rect x="11" y="52" width="22" height="3" rx="1.5"
          fill={active ? "#555" : "#333"}
          style={{ transition: "fill 0.2s" }}
        />
      </svg>

      <span style={{
        fontSize:      "clamp(10px, 1.3vw, 12px)",
        fontFamily:    "'Courier New', monospace",
        color:         active ? "#ddd" : "#777",
        letterSpacing: "0.04em",
        textAlign:     "center",
        lineHeight:    1.3,
        maxWidth:      "90px",
        wordBreak:     "break-word",
        transition:    "color 0.15s",
      }}>
        {label}
      </span>
    </div>
  );
};

export default FileIcon;