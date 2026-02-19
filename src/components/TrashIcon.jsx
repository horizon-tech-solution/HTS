import { useState } from "react";

const TrashIcon = ({ size = 52, label = "Recycle Bin", isEmpty = true, onDoubleClick }) => {
  const [hovered, setHovered] = useState(false);

  return (
    <div
      onDoubleClick={onDoubleClick}
      onMouseEnter={() => setHovered(true)}
      onMouseLeave={() => setHovered(false)}
      style={{
        display:       "flex",
        flexDirection: "column",
        alignItems:    "center",
        gap:           "8px",
        cursor:        "inherit",
        userSelect:    "none",
        transition:    "transform 0.15s",
        transform:     hovered ? "scale(1.08)" : "scale(1)",
      }}
    >
      <svg
        width={size * 0.84}
        height={size}
        viewBox="0 0 44 52"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        {/* Handle arc */}
        <path
          d="M16 5 C16 2 28 2 28 5"
          stroke={hovered ? "#111" : "#333"}
          strokeWidth="2.2" strokeLinecap="round" fill="none"
          style={{ transition: "stroke 0.2s" }}
        />
        {/* Lid */}
        <rect
          x="3" y="7" width="38" height="7" rx="3.5"
          fill={hovered ? "#e8e8f0" : "#f2f2f8"}
          stroke={hovered ? "#111" : "#333"}
          strokeWidth="2"
          style={{ transition: "all 0.2s" }}
        />
        {/* Body */}
        <path
          d="M7 14 L9 47 C9 48.7 10.3 50 12 50 L32 50 C33.7 50 35 48.7 35 47 L37 14 Z"
          fill={hovered ? "#ededf8" : "#f5f5fc"}
          stroke={hovered ? "#111" : "#333"}
          strokeWidth="2" strokeLinejoin="round"
          style={{ transition: "all 0.2s" }}
        />
        {/* Inner ribs */}
        <line x1="16" y1="20" x2="15" y2="44" stroke={hovered ? "#888" : "#c0c0d0"} strokeWidth="1.5" strokeLinecap="round" style={{ transition: "stroke 0.2s" }} />
        <line x1="22" y1="20" x2="22" y2="44" stroke={hovered ? "#888" : "#c0c0d0"} strokeWidth="1.5" strokeLinecap="round" style={{ transition: "stroke 0.2s" }} />
        <line x1="28" y1="20" x2="29" y2="44" stroke={hovered ? "#888" : "#c0c0d0"} strokeWidth="1.5" strokeLinecap="round" style={{ transition: "stroke 0.2s" }} />

        {/* Full indicator */}
        {!isEmpty && (
          <ellipse cx="22" cy="32" rx="9" ry="4" fill={hovered ? "#aaa" : "#ccc"} opacity="0.4" />
        )}
      </svg>

      <span style={{
        fontSize:      "11px",
        fontFamily:    "'Courier New', monospace",
        color:         "#222",
        letterSpacing: "0.04em",
        textAlign:     "center",
        lineHeight:    1.2,
        textShadow:    "0 1px 3px rgba(255,255,255,0.8)",
      }}>
        {label}
      </span>
    </div>
  );
};

export default TrashIcon;