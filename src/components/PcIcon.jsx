import { useState } from "react";

const PcIcon = ({ size = 52, label = "My PC", onClick }) => {
  const [hovered, setHovered] = useState(false);

  return (
    <div
      onClick={onClick}
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
        width={size}
        height={size}
        viewBox="0 0 52 52"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        {/* Monitor frame */}
        <rect
          x="3" y="3" width="46" height="32" rx="5"
          fill="none"
          stroke={hovered ? "#111" : "#333"}
          strokeWidth="2.2"
          style={{ transition: "stroke 0.2s" }}
        />
        {/* Screen */}
        <rect
          x="7" y="7" width="38" height="24" rx="3"
          fill={hovered ? "#e8f0ff" : "#f0f4ff"}
          style={{ transition: "fill 0.25s" }}
        />
        {/* Code lines */}
        <rect x="11" y="12" width="16" height="2" rx="1" fill={hovered ? "#4a90e2" : "#aab8d4"} style={{ transition: "fill 0.25s" }} />
        <rect x="11" y="17" width="11" height="2" rx="1" fill={hovered ? "#4a90e2" : "#aab8d4"} opacity="0.7" style={{ transition: "fill 0.25s" }} />
        <rect x="11" y="22" width="14" height="2" rx="1" fill={hovered ? "#4a90e2" : "#aab8d4"} opacity="0.5" style={{ transition: "fill 0.25s" }} />
        {/* Blinking cursor */}
        <rect x="29" y="12" width="2" height="9" rx="1" fill={hovered ? "#4a90e2" : "#8a9ec4"}>
          <animate attributeName="opacity" values="1;0;1" dur="1.1s" repeatCount="indefinite" />
        </rect>
        {/* Stand legs */}
        <path
          d="M22 35 L24 43 M30 35 L28 43"
          stroke={hovered ? "#111" : "#444"}
          strokeWidth="2" strokeLinecap="round"
          style={{ transition: "stroke 0.2s" }}
        />
        {/* Base */}
        <path
          d="M18 43 L34 43"
          stroke={hovered ? "#111" : "#444"}
          strokeWidth="2.5" strokeLinecap="round"
          style={{ transition: "stroke 0.2s" }}
        />
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

export default PcIcon;