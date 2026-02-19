// Homi.jsx
// Project file for Homi — opened from Projects folder inside MyPC
// Full screen viewer with project details, description, tech, and demo link

const Homi = ({ onClose }) => {
  return (
    <div style={{
      position:  "fixed",
      top: 0, left: 0, right: 0, bottom: 0,
      zIndex:    99999,
      background:"#0c0c0c",
      display:   "flex",
      flexDirection: "column",
      overflowY: "auto",
      WebkitOverflowScrolling: "touch",
    }}>
      {/* Top bar */}
      <div style={{
        position:   "sticky", top: 0, zIndex: 1,
        display:    "flex", alignItems: "center", justifyContent: "space-between",
        padding:    "0 clamp(16px, 5vw, 48px)",
        height:     "clamp(48px, 7vh, 60px)",
        background: "#0c0c0c",
        borderBottom:"1px solid #1a1a1a",
        flexShrink: 0,
      }}>
        <span style={{
          color: "#2e2e2e", fontSize: "11px",
          fontFamily: "'Courier New', monospace", letterSpacing: "0.08em",
        }}>
          projects / homi / homi.project
        </span>
        <button
          onClick={onClose}
          style={{
            background: "transparent", border: "1px solid #2a2a2a",
            color: "#555", cursor: "pointer", padding: "0 16px",
            height: "34px", borderRadius: "6px",
            fontFamily: "'Courier New', monospace", fontSize: "11px",
            letterSpacing: "0.06em", transition: "all 0.15s",
            WebkitTapHighlightColor: "transparent",
          }}
          onMouseEnter={(e) => { e.currentTarget.style.borderColor = "#555"; e.currentTarget.style.color = "#fff"; }}
          onMouseLeave={(e) => { e.currentTarget.style.borderColor = "#2a2a2a"; e.currentTarget.style.color = "#555"; }}
        >
          ✕ close
        </button>
      </div>

      {/* Content */}
      <div style={{
        flex: 1,
        display: "flex", justifyContent: "center",
        padding: "clamp(40px, 7vw, 90px) clamp(20px, 6vw, 60px)",
      }}>
        <div style={{ width: "100%", maxWidth: "700px", display: "flex", flexDirection: "column", gap: "clamp(28px, 5vh, 48px)" }}>

          {/* Accent + title */}
          <div>
            <div style={{ width: "36px", height: "3px", background: "#34d399", borderRadius: "2px", marginBottom: "28px" }} />
            <div style={{ display: "flex", alignItems: "flex-end", gap: "16px", flexWrap: "wrap", marginBottom: "12px" }}>
              <h1 style={{
                color: "#f0f0f0", fontFamily: "'Courier New', monospace",
                fontSize: "clamp(28px, 5vw, 48px)", fontWeight: "normal",
                letterSpacing: "0.06em", lineHeight: 1, margin: 0,
              }}>
                Homi
              </h1>
              <span style={{
                color: "#34d399", fontFamily: "'Courier New', monospace",
                fontSize: "clamp(9px, 1.1vw, 11px)", letterSpacing: "0.14em",
                textTransform: "uppercase", marginBottom: "8px",
                border: "1px solid #34d399", padding: "3px 10px", borderRadius: "20px",
              }}>
                Live
              </span>
            </div>
            <p style={{
              color: "#555", fontFamily: "'Courier New', monospace",
              fontSize: "clamp(12px, 1.6vw, 14px)", letterSpacing: "0.06em",
              textTransform: "uppercase",
            }}>
              Property Discovery Platform · Cameroon
            </p>
          </div>

          {/* The idea */}
          <div>
            <p style={{ color: "#2e2e2e", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.14em", textTransform: "uppercase", marginBottom: "16px" }}>
              the_idea.txt
            </p>
            <pre style={{
              fontFamily: "'Courier New', monospace",
              fontSize: "clamp(13px, 1.9vw, 17px)",
              color: "#999", lineHeight: 2.1,
              whiteSpace: "pre-wrap", margin: 0,
              letterSpacing: "0.01em",
            }}>
{`Finding a property in Cameroon
meant asking a friend of a friend,
driving around neighborhoods looking for signs,
or trusting a broker you just met.

Homi changes that.

It's a property platform built specifically
for the Cameroonian market —
where individuals, landlords, and real estate agents
can list houses for sale, apartments for rent,
commercial spaces, shops, and land.

And where anyone looking to buy, rent,
or lease a property can find exactly what they need —
by city, neighborhood, price range, or property type —
and connect directly with the listing owner.

No middlemen taking extra cuts.
No confusion about who to call.
Just properties. Just people. Just deals.`}
            </pre>
          </div>

          <div style={{ height: "1px", background: "#1a1a1a" }} />

          {/* What it does */}
          <div>
            <p style={{ color: "#2e2e2e", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.14em", textTransform: "uppercase", marginBottom: "20px" }}>
              features.log
            </p>
            <div style={{ display: "flex", flexDirection: "column", gap: "10px" }}>
              {[
                ["Property Listings",       "Individuals and agents list houses, apartments, shops, land, and commercial spaces for sale or rent."],
                ["Location-Based Search",   "Filter by city, neighborhood, or area across Cameroon. Find what's available near you."],
                ["Property Types",          "Residential, commercial, mixed-use. Rent or buy. Short-term or long-term. All in one place."],
                ["Direct Contact",          "Buyers and renters connect directly with listing owners — no unnecessary intermediaries."],
                ["Agent Profiles",          "Real estate agents get dedicated profiles to showcase their listings and build credibility."],
                ["Media-Rich Listings",     "Photos, descriptions, pricing, and key property details — everything needed to make a decision."],
              ].map(([title, desc]) => (
                <div
                  key={title}
                  style={{
                    display: "flex", gap: "16px", alignItems: "flex-start",
                    padding: "14px 16px", borderRadius: "8px",
                    border: "1px solid #1a1a1a", background: "#111",
                  }}
                >
                  <span style={{ color: "#34d399", fontFamily: "'Courier New', monospace", fontSize: "12px", flexShrink: 0, marginTop: "1px" }}>→</span>
                  <div>
                    <p style={{ color: "#ccc", fontFamily: "'Courier New', monospace", fontSize: "clamp(11px, 1.4vw, 13px)", marginBottom: "4px", letterSpacing: "0.03em" }}>
                      {title}
                    </p>
                    <p style={{ color: "#444", fontFamily: "'Courier New', monospace", fontSize: "clamp(10px, 1.2vw, 12px)", lineHeight: 1.7 }}>
                      {desc}
                    </p>
                  </div>
                </div>
              ))}
            </div>
          </div>

          <div style={{ height: "1px", background: "#1a1a1a" }} />

          {/* Tech stack */}
          <div>
            <p style={{ color: "#2e2e2e", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.14em", textTransform: "uppercase", marginBottom: "16px" }}>
              stack.config
            </p>
            <div style={{ display: "flex", flexWrap: "wrap", gap: "8px" }}>
              {["React", "Node.js", "MongoDB", "Cloudinary", "Vercel", "Netlify"].map((tech) => (
                <span
                  key={tech}
                  style={{
                    padding: "5px 14px", borderRadius: "20px",
                    border: "1px solid #2a2a2a", background: "#141414",
                    color: "#555", fontFamily: "'Courier New', monospace",
                    fontSize: "clamp(9px, 1.1vw, 11px)", letterSpacing: "0.08em",
                  }}
                >
                  {tech}
                </span>
              ))}
            </div>
          </div>

          <div style={{ height: "1px", background: "#1a1a1a" }} />

          {/* Status + demo */}
          <div style={{ display: "flex", flexWrap: "wrap", gap: "clamp(16px, 3vw, 28px)", alignItems: "flex-start" }}>
            {/* Status block */}
            <div style={{ display: "flex", flexDirection: "column", gap: "12px", flex: 1, minWidth: "160px" }}>
              {[
                ["status",  "live"],
                ["market",  "Cameroon"],
                ["type",    "Web Platform"],
              ].map(([k, v]) => (
                <div key={k}>
                  <p style={{ color: "#2e2e2e", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.12em", textTransform: "uppercase", marginBottom: "3px" }}>{k}</p>
                  <p style={{ color: k === "status" ? "#34d399" : "#666", fontFamily: "'Courier New', monospace", fontSize: "clamp(11px,1.3vw,13px)" }}>{v}</p>
                </div>
              ))}
            </div>

            {/* Demo CTA */}
            <div style={{ display: "flex", flexDirection: "column", gap: "10px", flex: 1, minWidth: "180px" }}>
              <a
                href="https://homi-pj.netlify.app"
                target="_blank"
                rel="noopener noreferrer"
                style={{
                  display: "inline-flex", alignItems: "center", justifyContent: "center",
                  gap: "10px", padding: "13px 24px",
                  background: "#34d39918", border: "1px solid #34d399",
                  color: "#34d399", borderRadius: "7px",
                  fontFamily: "'Courier New', monospace",
                  fontSize: "clamp(11px, 1.4vw, 13px)",
                  letterSpacing: "0.06em", textDecoration: "none",
                  transition: "all 0.18s",
                  WebkitTapHighlightColor: "transparent",
                }}
                onMouseEnter={(e) => { e.currentTarget.style.background = "#34d39928"; }}
                onMouseLeave={(e) => { e.currentTarget.style.background = "#34d39918"; }}
              >
                ↗ view live demo
              </a>
              <p style={{ color: "#2a2a2a", fontFamily: "'Courier New', monospace", fontSize: "10px", letterSpacing: "0.04em", textAlign: "center" }}>
                homi-pj.netlify.app
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>
  );
};

export default Homi;