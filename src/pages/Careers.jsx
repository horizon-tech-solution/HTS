import { useState } from "react";
import FileIcon from "../components/FileIcon";

// ─── EDIT THESE ────────────────────────────────────────────────────────────────
const COMPANY_NAME = "Your Company";

const OPENINGS = [
  {
    id:       "fullstack",
    label:    "fullstack_dev.role",
    color:    "#60a5fa",
    title:    "Full-Stack Developer",
    type:     "Full-time · Remote",
    stack:    "React · Node.js · PostgreSQL · AWS",
    intro:    `We don't hire developers.
We hire people who solve problems
and happen to write code.`,
    body: `You'll be working on real products
for real clients — from architecture decisions
to production deployments.

No bureaucracy. No 6-month roadmaps.
Just a small team moving fast
and building things that work.

What you'll do:
→ Design and build full-stack web applications
→ Own features from spec to deployment
→ Work directly with clients and stakeholders
→ Review code, improve systems, raise the bar
→ Help decide what we build next

What we're looking for:
→ 2+ years of professional experience
→ Strong fundamentals — not just framework knowledge
→ Someone who ships and iterates, not perfects forever
→ Clear communication — written especially
→ Genuine curiosity about how things work`,
    apply:    "careers@yourcompany.com",
  },
  {
    id:       "backend",
    label:    "backend_engineer.role",
    color:    "#34d399",
    title:    "Backend Engineer",
    type:     "Full-time · Remote",
    stack:    "Node.js · Python · PostgreSQL · Redis · Docker",
    intro:    `The backend is where the real problems live.
If you enjoy solving them, keep reading.`,
    body: `We build systems that handle real load,
real data, and real consequences.

You'll design APIs, optimize queries,
architect data pipelines, and keep
everything running reliably.

What you'll do:
→ Build and maintain REST & GraphQL APIs
→ Design database schemas and optimize queries
→ Build automation and data processing pipelines
→ Integrate third-party services and APIs
→ Monitor, debug, and improve system performance

What we're looking for:
→ Strong knowledge of at least one backend language
→ Experience with SQL and database design
→ Comfort with cloud infrastructure (AWS/GCP/Azure)
→ Understanding of security and scalability principles
→ Experience with Docker and CI/CD pipelines`,
    apply:    "careers@yourcompany.com",
  },
  {
    id:       "designer",
    label:    "ui_ux_designer.role",
    color:    "#f472b6",
    title:    "UI/UX Designer",
    type:     "Full-time · Remote",
    stack:    "Figma · Framer · Design Systems",
    intro:    `We believe design is a competitive advantage.
We're looking for someone who believes the same.`,
    body: `You'll design interfaces that people
actually enjoy using — not just ones
that pass a usability test.

You'll work closely with developers
and directly with clients.
Your designs will get built. Exactly.

What you'll do:
→ Design web and mobile interfaces end-to-end
→ Build and maintain design systems
→ Conduct user research and usability testing
→ Translate complex workflows into simple UX
→ Create prototypes that feel like the real thing

What we're looking for:
→ A portfolio that shows range and depth
→ Strong visual design fundamentals
→ Experience working in fast-moving product teams
→ Ability to justify design decisions clearly
→ Figma proficiency`,
    apply:    "careers@yourcompany.com",
  },
  {
    id:       "sales",
    label:    "business_dev.role",
    color:    "#fbbf24",
    title:    "Business Development",
    type:     "Full-time · Remote / Hybrid",
    stack:    "CRM · Outreach · Strategy",
    intro:    `We build great software.
We need someone who can find the people
who need it most.`,
    body: `This role is about relationship-building,
not cold calling quotas.

You'll identify companies with real problems
we can solve, start genuine conversations,
and close deals that make sense for everyone.

What you'll do:
→ Identify and research target clients
→ Build relationships with decision-makers
→ Run discovery calls and qualify opportunities
→ Work with technical team to scope proposals
→ Manage pipeline and report on progress

What we're looking for:
→ Experience selling B2B software or services
→ Genuine interest in technology and business
→ Clear, persuasive written and verbal communication
→ Self-directed — you don't need to be told what to do
→ Honesty over hustle`,
    apply:    "careers@yourcompany.com",
  },
];

const CULTURE_NOTES = [
  "We work async-first. Meetings are rare and purposeful.",
  "We write things down. Documentation is not optional.",
  "We ship small and often. Perfection is the enemy of done.",
  "We say what we think. Respectfully, but directly.",
  "We treat people like adults.",
];

// ─── Fullscreen job viewer ─────────────────────────────────────────────────────
const JobViewer = ({ job, onClose }) => (
  <div style={{
    position: "fixed", top: 0, left: 0, right: 0, bottom: 0,
    zIndex: 99999, background: "#0c0c0c",
    display: "flex", flexDirection: "column",
    overflowY: "auto", WebkitOverflowScrolling: "touch",
  }}>
    {/* Top bar */}
    <div style={{
      position: "sticky", top: 0, zIndex: 1,
      display: "flex", alignItems: "center", justifyContent: "space-between",
      padding: "0 clamp(16px, 5vw, 48px)",
      height: "clamp(48px, 7vh, 60px)",
      background: "#0c0c0c", borderBottom: "1px solid #1a1a1a", flexShrink: 0,
    }}>
      <span style={{ color: "#2e2e2e", fontSize: "11px", fontFamily: "'Courier New', monospace", letterSpacing: "0.08em" }}>
        careers / {job.label}
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
      flex: 1, display: "flex", alignItems: "flex-start", justifyContent: "center",
      padding: "clamp(40px, 7vw, 90px) clamp(20px, 6vw, 60px)",
    }}>
      <div style={{ width: "100%", maxWidth: "640px", display: "flex", flexDirection: "column", gap: "32px" }}>
        {/* Accent */}
        <div style={{ width: "36px", height: "3px", background: job.color, borderRadius: "2px" }} />

        {/* Title + meta */}
        <div>
          <h1 style={{
            color: "#e8e8e8", fontFamily: "'Courier New', monospace",
            fontSize: "clamp(20px, 3.5vw, 30px)", fontWeight: "normal",
            letterSpacing: "0.03em", marginBottom: "10px", lineHeight: 1.3,
          }}>
            {job.title}
          </h1>
          <p style={{ color: job.color, fontFamily: "'Courier New', monospace", fontSize: "12px", letterSpacing: "0.08em", marginBottom: "6px" }}>
            {job.type}
          </p>
          <p style={{ color: "#3a3a3a", fontFamily: "'Courier New', monospace", fontSize: "11px", letterSpacing: "0.06em" }}>
            {job.stack}
          </p>
        </div>

        {/* Intro */}
        <pre style={{
          fontFamily: "'Courier New', monospace",
          fontSize: "clamp(14px, 2vw, 18px)",
          color: "#aaa", lineHeight: 2, whiteSpace: "pre-wrap",
          margin: 0, borderLeft: `2px solid ${job.color}`,
          paddingLeft: "20px",
        }}>
          {job.intro}
        </pre>

        {/* Body */}
        <pre style={{
          fontFamily: "'Courier New', monospace",
          fontSize: "clamp(12px, 1.6vw, 14px)",
          color: "#666", lineHeight: 2.1,
          whiteSpace: "pre-wrap", margin: 0, letterSpacing: "0.01em",
        }}>
          {job.body}
        </pre>

        {/* Apply CTA */}
        <div style={{ borderTop: "1px solid #1a1a1a", paddingTop: "28px", display: "flex", flexDirection: "column", gap: "12px" }}>
          <p style={{ color: "#3a3a3a", fontFamily: "'Courier New', monospace", fontSize: "11px", letterSpacing: "0.1em", textTransform: "uppercase" }}>
            How to apply
          </p>
          <p style={{ color: "#666", fontFamily: "'Courier New', monospace", fontSize: "13px", lineHeight: 1.8 }}>
            Send your CV and a short note about why this role to:
          </p>
          <a
            href={`mailto:${job.apply}?subject=Application: ${job.title}`}
            style={{
              display: "inline-flex", alignItems: "center", gap: "10px",
              padding: "12px 24px", border: `1px solid ${job.color}`,
              color: job.color, borderRadius: "6px",
              fontFamily: "'Courier New', monospace", fontSize: "13px",
              letterSpacing: "0.06em", textDecoration: "none",
              transition: "all 0.18s", alignSelf: "flex-start",
            }}
            onMouseEnter={(e) => { e.currentTarget.style.background = job.color + "18"; }}
            onMouseLeave={(e) => { e.currentTarget.style.background = "transparent"; }}
          >
            apply_now → {job.apply}
          </a>
        </div>
      </div>
    </div>
  </div>
);

// ─── Careers page ──────────────────────────────────────────────────────────────
const Careers = () => {
  const [open,     setOpen]     = useState(null);
  const [selected, setSelected] = useState(null);

  return (
    <>
      <div
        style={{ width: "100%", height: "100%", overflowY: "auto", WebkitOverflowScrolling: "touch", padding: "clamp(16px,3vw,28px)", display: "flex", flexDirection: "column", gap: "clamp(20px,4vh,28px)" }}
        onClick={() => setSelected(null)}
      >
        <p style={{ color: "#333", fontSize: "10px", fontFamily: "'Courier New', monospace", letterSpacing: "0.1em", textTransform: "uppercase" }}>
          Careers — {OPENINGS.length} open roles
        </p>

        {/* Culture blurb */}
        <div style={{
          background: "#161616", border: "1px solid #1e1e1e",
          borderRadius: "8px", padding: "clamp(14px,2.5vw,20px)",
          display: "flex", flexDirection: "column", gap: "8px",
        }}>
          <p style={{ color: "#3a3a3a", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.12em", textTransform: "uppercase", marginBottom: "4px" }}>
            how_we_work.txt
          </p>
          {CULTURE_NOTES.map((note, i) => (
            <p key={i} style={{ color: "#555", fontSize: "clamp(10px,1.3vw,12px)", fontFamily: "'Courier New', monospace", lineHeight: 1.7 }}>
              <span style={{ color: "#2e2e2e", marginRight: "8px" }}>→</span>{note}
            </p>
          ))}
        </div>

        {/* Job files */}
        <div>
          <p style={{ color: "#2e2e2e", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.12em", textTransform: "uppercase", marginBottom: "14px" }}>
            open_positions/
          </p>
          <div style={{ display: "grid", gridTemplateColumns: "repeat(auto-fill, minmax(100px, 1fr))", gap: "8px" }}>
            {OPENINGS.map((job) => (
              <FileIcon
                key={job.id}
                label={job.label}
                size={72}
                color={job.color}
                selected={selected === job.id}
                onClick={(e) => { e.stopPropagation(); setOpen(job); }}
              />
            ))}
          </div>
        </div>

        <p style={{ color: "#282828", fontSize: "10px", fontFamily: "'Courier New', monospace", letterSpacing: "0.06em" }}>
          double-click hint removed — click to open
        </p>
      </div>

      {open && <JobViewer job={open} onClose={() => setOpen(null)} />}
    </>
  );
};

export default Careers;