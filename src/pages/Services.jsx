import { useState } from "react";
import FileIcon from "../components/FileIcon";

// ─── Services data ─────────────────────────────────────────────────────────────
const SERVICES = [
  {
    id:    "custom-software",
    label: "custom_software",
    color: "#60a5fa",
    title: "Custom Software Development",
    tagline: "Built for your problem. Not someone else's.",
    body: `Off-the-shelf software is built for the average.
Your business is not average.

We design and build software from the ground up —
tailored to your workflows, your team, your goals.

Whether it's an internal tool that saves your team
3 hours a day, or a customer-facing platform that
scales to millions — we engineer it right.

→ Web applications
→ Desktop software
→ Internal tools & dashboards
→ API design & integration
→ Legacy system modernization`,
  },
  {
    id:    "automation",
    label: "automation",
    color: "#34d399",
    title: "Business Process Automation",
    tagline: "Stop paying people to do what machines can do better.",
    body: `Every hour your team spends on repetitive tasks
is an hour they're not spending on growth.

We identify, design, and deploy automation systems
that eliminate bottlenecks and free your people
to do the work that actually requires a human.

The result: lower costs, fewer errors,
and a team that moves faster.

→ Workflow automation
→ Data entry & processing pipelines
→ Report generation
→ Email & notification systems
→ CRM & ERP integration`,
  },
  {
    id:    "analytics",
    label: "analytics",
    color: "#fbbf24",
    title: "Data & Analytics Solutions",
    tagline: "You have the data. We make it useful.",
    body: `Most companies are sitting on gold
and calling it a storage problem.

We build systems that collect, clean, and surface
your data as actionable insight — in real time,
in a format your team actually understands.

Decision-making stops being a gut feeling.
It becomes a competitive advantage.

→ Custom dashboards & reporting
→ Data pipeline architecture
→ KPI tracking systems
→ Predictive analytics
→ Business intelligence tools`,
  },
  {
    id:    "saas",
    label: "saas_product",
    color: "#a78bfa",
    title: "SaaS Product Development",
    tagline: "Turn your idea into a product people pay for.",
    body: `You have an idea for a software product.
You need a team that can build it
and a strategy that can sell it.

We take SaaS products from concept to launch —
architecture, design, development, deployment.
Built to scale from day one.

We've done this before.
We know what breaks at 10 users
and what breaks at 10,000.

→ MVP development
→ Multi-tenant architecture
→ Subscription & billing integration
→ User onboarding flows
→ Scalable cloud infrastructure`,
  },
  {
    id:    "integration",
    label: "integrations",
    color: "#fb923c",
    title: "System Integration",
    tagline: "Make your tools talk to each other.",
    body: `The average company uses 130 different software tools.
Most of them don't talk to each other.

That gap costs time, causes errors,
and creates invisible inefficiencies
nobody can even measure.

We connect your systems — old and new —
so data flows where it needs to go,
automatically, reliably, in real time.

→ API development & documentation
→ Third-party integrations (Salesforce, HubSpot, SAP...)
→ Webhook & event-driven systems
→ Data sync & migration
→ Microservices architecture`,
  },
  {
    id:    "consulting",
    label: "tech_consulting",
    color: "#f472b6",
    title: "Technology Consulting",
    tagline: "An outside eye on your inside problems.",
    body: `Sometimes you don't need more code.
You need someone who can look at what you have
and tell you what's actually wrong.

We audit your existing tech stack,
identify what's slowing you down,
and give you a clear roadmap for fixing it —
whether we build it or you do.

No jargon. No upselling.
Just honest technical guidance.

→ Tech stack audits
→ Architecture review
→ Scalability assessment
→ Build vs buy analysis
→ CTO-as-a-service`,
  },
];

// ─── Fullscreen viewer ─────────────────────────────────────────────────────────
const ServiceViewer = ({ service, onClose }) => {
  if (!service) return null;

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
        <span style={{ color: "#2e2e2e", fontSize: "11px", fontFamily: "'Courier New', monospace", letterSpacing: "0.08em" }}>
          services / {service.label}
        </span>
        <button
          onClick={onClose}
          style={{
            background: "transparent", border: "1px solid #2a2a2a",
            color: "#555", cursor: "pointer",
            padding: "0 16px", height: "34px", borderRadius: "6px",
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
        display: "flex", alignItems: "flex-start", justifyContent: "center",
        padding: "clamp(40px, 8vw, 100px) clamp(20px, 6vw, 60px)",
      }}>
        <div style={{ width: "100%", maxWidth: "640px" }}>
          {/* Accent line */}
          <div style={{ width: "40px", height: "3px", background: service.color, borderRadius: "2px", marginBottom: "32px" }} />

          <h1 style={{
            color: "#e8e8e8", fontFamily: "'Courier New', monospace",
            fontSize: "clamp(20px, 3.5vw, 32px)", fontWeight: "normal",
            letterSpacing: "0.03em", marginBottom: "14px", lineHeight: 1.3,
          }}>
            {service.title}
          </h1>

          <p style={{
            color: service.color, fontFamily: "'Courier New', monospace",
            fontSize: "clamp(12px, 1.6vw, 14px)", letterSpacing: "0.05em",
            marginBottom: "48px", fontStyle: "italic",
          }}>
            {service.tagline}
          </p>

          <pre style={{
            fontFamily: "'Courier New', monospace",
            fontSize: "clamp(13px, 1.8vw, 16px)",
            color: "#888", lineHeight: 2.1,
            whiteSpace: "pre-wrap", margin: 0,
            letterSpacing: "0.01em",
          }}>
            {service.body}
          </pre>

          {/* CTA */}
          <div style={{ marginTop: "clamp(40px, 6vh, 64px)" }}>
            <a
              href="#contact"
              onClick={onClose}
              style={{
                display: "inline-flex", alignItems: "center", gap: "10px",
                padding: "12px 24px", border: `1px solid ${service.color}`,
                color: service.color, borderRadius: "6px",
                fontFamily: "'Courier New', monospace", fontSize: "13px",
                letterSpacing: "0.06em", textDecoration: "none",
                transition: "all 0.18s",
              }}
              onMouseEnter={(e) => { e.currentTarget.style.background = service.color + "18"; }}
              onMouseLeave={(e) => { e.currentTarget.style.background = "transparent"; }}
            >
              Talk to us about this →
            </a>
          </div>
        </div>
      </div>
    </div>
  );
};

// ─── Services page ─────────────────────────────────────────────────────────────
const Services = () => {
  const [open, setOpen] = useState(null);

  return (
    <>
      <div
        style={{ width: "100%", height: "100%", padding: "clamp(16px,3vw,28px)", overflowY: "auto", WebkitOverflowScrolling: "touch" }}
        onClick={() => setOpen(null)}
      >
        <p style={{ color: "#333", fontSize: "10px", fontFamily: "'Courier New', monospace", letterSpacing: "0.1em", marginBottom: "clamp(16px,3vh,24px)", textTransform: "uppercase" }}>
          Services — {SERVICES.length} files
        </p>

        <div style={{ display: "grid", gridTemplateColumns: "repeat(auto-fill, minmax(100px, 1fr))", gap: "8px" }}>
          {SERVICES.map((svc) => (
            <FileIcon
              key={svc.id}
              label={svc.label}
              size={72}
              color={svc.color}
              selected={open?.id === svc.id}
              onClick={(e) => { e.stopPropagation(); setOpen(svc); }}
            />
          ))}
        </div>
      </div>

      {open && <ServiceViewer service={open} onClose={() => setOpen(null)} />}
    </>
  );
};

export default Services;