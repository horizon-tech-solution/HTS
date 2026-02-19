import { useState, useEffect } from "react";
import FileIcon from "../components/FileIcon";

// ─── EDIT THESE ────────────────────────────────────────────────────────────────
const COMPANY_NAME = "Your Company";

const COMPANY_STORY = `We didn't start with a pitch deck,
or a conference room full of suits.
We started with a question —
what if things actually worked?

Built in the quiet hours,
debugged on bad coffee,
shipped with shaking hands.

We are the ones who stayed
when the problem got harder.
We are the ones who believed
the gap between broken and beautiful
was just work.

This is that work.
This is us.`;

// Replace photo: null with your image path e.g. "/assets/team/name.jpg"
const TEAM = [
  {
    name:  "Mushieh Edison",
    role:  "Founder & CEO",
    photo: null,
    accent:"#60a5fa",
    bio:   "Visionary, builder, and the person who started this whole thing on a Tuesday night. Passionate about technology, design, and making things that matter.",
  },
  {
    name:  "Team Member",
    role:  "Lead Developer",
    photo: null,
    accent:"#34d399",
    bio:   "Turns caffeine into code. Obsessed with clean architecture and fast interfaces.",
  },
  {
    name:  "Team Member",
    role:  "Designer",
    photo: null,
    accent:"#f472b6",
    bio:   "Makes things look like they were always supposed to be that way. Pixel-obsessed, detail-driven.",
  },
  {
    name:  "Team Member",
    role:  "Operations",
    photo: null,
    accent:"#fbbf24",
    bio:   "The person who makes sure everything that should happen, happens. Keeps the machine running quietly.",
  },
];

// ─── True Fullscreen Viewer ────────────────────────────────────────────────────
const FullscreenViewer = ({ type, onClose }) => {
  // Lock body scroll while open
  useEffect(() => {
    const prev = document.body.style.overflow;
    document.body.style.overflow = "hidden";
    return () => { document.body.style.overflow = prev; };
  }, []);

  // Close on Escape
  useEffect(() => {
    const handler = (e) => { if (e.key === "Escape") onClose(); };
    window.addEventListener("keydown", handler);
    return () => window.removeEventListener("keydown", handler);
  }, [onClose]);

  return (
    // Covers EVERYTHING — sits above every z-index including MyPC window
    <div style={{
      position:   "fixed",
      top:        0, left: 0, right: 0, bottom: 0,
      zIndex:     99999,
      background: "#0c0c0c",
      display:    "flex",
      flexDirection: "column",
      overflowY:  "auto",
      overflowX:  "hidden",
      WebkitOverflowScrolling: "touch",
    }}>

      {/* ── Top bar ── */}
      <div style={{
        position:   "sticky",
        top:        0,
        zIndex:     1,
        display:    "flex",
        alignItems: "center",
        justifyContent: "space-between",
        padding:    "0 clamp(16px, 4vw, 40px)",
        height:     "clamp(48px, 7vh, 60px)",
        background: "#0c0c0c",
        borderBottom: "1px solid #1a1a1a",
        flexShrink:  0,
      }}>
        <span style={{
          color:         "#3a3a3a",
          fontSize:      "clamp(10px, 1.2vw, 12px)",
          fontFamily:    "'Courier New', monospace",
          letterSpacing: "0.08em",
        }}>
          {type === "story" ? `${COMPANY_NAME} — story.txt` : `${COMPANY_NAME} — team.profile`}
        </span>

        {/* Close button — big enough for mobile */}
        <button
          onClick={onClose}
          style={{
            background:    "transparent",
            border:        "1px solid #2a2a2a",
            color:         "#555",
            cursor:        "pointer",
            padding:       "0 16px",
            height:        "36px",
            borderRadius:  "6px",
            fontFamily:    "'Courier New', monospace",
            fontSize:      "12px",
            letterSpacing: "0.06em",
            transition:    "all 0.15s",
            display:       "flex",
            alignItems:    "center",
            gap:           "6px",
            WebkitTapHighlightColor: "transparent",
            minWidth:      "80px",
            justifyContent:"center",
          }}
          onMouseEnter={(e) => { e.currentTarget.style.borderColor = "#555"; e.currentTarget.style.color = "#fff"; }}
          onMouseLeave={(e) => { e.currentTarget.style.borderColor = "#2a2a2a"; e.currentTarget.style.color = "#555"; }}
        >
          ✕ close
        </button>
      </div>

      {/* ── STORY content ── */}
      {type === "story" && (
        <div style={{
          flex:      1,
          display:   "flex",
          alignItems:"flex-start",
          justifyContent:"center",
          padding:   "clamp(40px, 8vw, 100px) clamp(20px, 6vw, 60px)",
        }}>
          <div style={{ width: "100%", maxWidth: "600px" }}>
            <p style={{
              color:         "#222",
              fontSize:      "clamp(9px, 1.1vw, 11px)",
              fontFamily:    "'Courier New', monospace",
              letterSpacing: "0.16em",
              textTransform: "uppercase",
              marginBottom:  "clamp(32px, 6vh, 64px)",
            }}>
              {COMPANY_NAME} / story.txt
            </p>
            <pre style={{
              fontFamily:    "'Courier New', monospace",
              fontSize:      "clamp(14px, 2.4vw, 22px)",
              color:         "#bbb",
              lineHeight:    2.2,
              whiteSpace:    "pre-wrap",
              margin:        0,
              letterSpacing: "0.01em",
            }}>
              {COMPANY_STORY}
            </pre>
          </div>
        </div>
      )}

      {/* ── TEAM content ── */}
      {type === "team" && (
        <div style={{
          flex:    1,
          padding: "clamp(32px, 6vw, 80px) clamp(16px, 5vw, 48px)",
        }}>
          <p style={{
            color:         "#222",
            fontSize:      "clamp(9px, 1.1vw, 11px)",
            fontFamily:    "'Courier New', monospace",
            letterSpacing: "0.16em",
            textTransform: "uppercase",
            marginBottom:  "clamp(28px, 5vh, 56px)",
            textAlign:     "center",
          }}>
            {COMPANY_NAME} / team.profile
          </p>

          <div style={{
            display:             "grid",
            gridTemplateColumns: "repeat(auto-fill, minmax(clamp(150px, 22vw, 220px), 1fr))",
            gap:                 "clamp(16px, 3vw, 32px)",
            maxWidth:            "960px",
            margin:              "0 auto",
          }}>
            {TEAM.map((member, i) => (
              <div
                key={i}
                style={{
                  display:       "flex",
                  flexDirection: "column",
                  alignItems:    "center",
                  gap:           "clamp(12px, 2vw, 18px)",
                  padding:       "clamp(20px, 3vw, 32px) clamp(14px, 2vw, 24px)",
                  borderRadius:  "12px",
                  border:        "1px solid #1a1a1a",
                  background:    "#111",
                }}
              >
                {/* Photo */}
                <div style={{
                  width:          "clamp(64px, 10vw, 96px)",
                  height:         "clamp(64px, 10vw, 96px)",
                  borderRadius:   "50%",
                  border:         `2px solid ${member.accent}`,
                  background:     "#1a1a1a",
                  overflow:       "hidden",
                  display:        "flex",
                  alignItems:     "center",
                  justifyContent: "center",
                  flexShrink:     0,
                }}>
                  {member.photo
                    ? <img src={member.photo} alt={member.name} style={{ width: "100%", height: "100%", objectFit: "cover" }} />
                    : <span style={{ fontSize: "clamp(22px, 4vw, 32px)", opacity: 0.3 }}>◯</span>
                  }
                </div>

                {/* Name */}
                <div style={{ textAlign: "center" }}>
                  <p style={{
                    color:         "#ddd",
                    fontSize:      "clamp(12px, 1.5vw, 14px)",
                    fontFamily:    "'Courier New', monospace",
                    letterSpacing: "0.04em",
                    marginBottom:  "5px",
                  }}>
                    {member.name}
                  </p>
                  <p style={{
                    color:         member.accent,
                    fontSize:      "clamp(9px, 1.1vw, 11px)",
                    fontFamily:    "'Courier New', monospace",
                    letterSpacing: "0.12em",
                    textTransform: "uppercase",
                  }}>
                    {member.role}
                  </p>
                </div>

                <div style={{ width: "100%", height: "1px", background: "#1e1e1e" }} />

                {/* Bio */}
                <p style={{
                  color:         "#555",
                  fontSize:      "clamp(10px, 1.3vw, 12px)",
                  fontFamily:    "'Courier New', monospace",
                  lineHeight:    1.9,
                  textAlign:     "center",
                  letterSpacing: "0.01em",
                }}>
                  {member.bio}
                </p>
              </div>
            ))}
          </div>
        </div>
      )}
    </div>
  );
};

// ─── About page ────────────────────────────────────────────────────────────────
// Double-tap on mobile = double-click on desktop
const About = () => {
  const [open,     setOpen]     = useState(null);
  const [selected, setSelected] = useState(null);



  return (
    <>
      <div
        style={{
          width:    "100%",
          height:   "100%",
          padding:  "clamp(16px, 3vw, 28px)",
          overflowY:"auto",
          WebkitOverflowScrolling: "touch",
        }}
        onClick={() => setSelected(null)}
      >
        <p style={{
          color:         "#333",
          fontSize:      "clamp(9px, 1.1vw, 10px)",
          fontFamily:    "'Courier New', monospace",
          letterSpacing: "0.1em",
          marginBottom:  "clamp(16px, 3vh, 24px)",
          textTransform: "uppercase",
        }}>
          About Us — 2 files
        </p>

        <div style={{
          display:  "flex",
          gap:      "clamp(8px, 2vw, 20px)",
          flexWrap: "wrap",
          alignItems:"flex-start",
        }}>
          {/* story.txt */}
          <FileIcon
            label="story.txt"
            size={clampSize()}
            color="#a78bfa"
            selected={selected === "story"}
            onClick={(e) => { e.stopPropagation(); setOpen("story"); }}
          />

          {/* team.profile */}
          <FileIcon
            label="team.profile"
            size={clampSize()}
            color="#60a5fa"
            selected={selected === "team"}
            onClick={(e) => { e.stopPropagation(); setOpen("team"); }}
          />
        </div>


      </div>

      {/* TRUE FULLSCREEN — above everything */}
      {open && <FullscreenViewer type={open} onClose={() => setOpen(null)} />}
    </>
  );
};

// Returns a responsive icon size based on screen width
function clampSize() {
  const vw = window.innerWidth;
  if (vw < 400) return 60;
  if (vw < 768) return 68;
  return 80;
}

export default About;