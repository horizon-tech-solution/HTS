import { useState } from "react";

// ─── Contact.jsx ───────────────────────────────────────────────────────────────
// Styled as a terminal/form — consistent with the desktop OS aesthetic
// Replace CONTACT_INFO with real details

const CONTACT_INFO = {
  email:    "horizontechsolution680@gmail.com",
  location: "cameroon",
  response: "We respond within 24 hours.",
};

const FIELDS = [
  { id: "name",    label: "your_name",    type: "text",     placeholder: "John Doe",              required: true  },
  { id: "email",   label: "email_address",type: "email",    placeholder: "john@company.com",      required: true  },
  { id: "company", label: "company_name", type: "text",     placeholder: "Acme Corp (optional)",  required: false },
  { id: "subject", label: "subject",      type: "text",     placeholder: "What is this about?",   required: true  },
];

const Contact = () => {
  const [form,     setForm]     = useState({ name: "", email: "", company: "", subject: "", message: "" });
  const [focused,  setFocused]  = useState(null);
  const [sent,     setSent]     = useState(false);
  const [sending,  setSending]  = useState(false);
  const [errors,   setErrors]   = useState({});

  const validate = () => {
    const e = {};
    if (!form.name.trim())    e.name    = "required";
    if (!form.email.trim())   e.email   = "required";
    if (!/\S+@\S+\.\S+/.test(form.email)) e.email = "invalid email";
    if (!form.subject.trim()) e.subject = "required";
    if (!form.message.trim()) e.message = "required";
    return e;
  };

  const handleSubmit = async () => {
    const e = validate();
    if (Object.keys(e).length > 0) { setErrors(e); return; }
    setErrors({});
    setSending(true);
    // Simulate send — replace with your actual API call
    await new Promise((r) => setTimeout(r, 1400));
    setSending(false);
    setSent(true);
  };

  const inputStyle = (id) => ({
    width:         "100%",
    background:    "transparent",
    border:        "none",
    borderBottom:  `1px solid ${errors[id] ? "#f87171" : focused === id ? "#a78bfa" : "#2a2a2a"}`,
    outline:       "none",
    color:         "#ddd",
    fontSize:      "clamp(12px, 1.5vw, 14px)",
    fontFamily:    "'Courier New', monospace",
    letterSpacing: "0.03em",
    padding:       "10px 0",
    transition:    "border-color 0.2s",
    caretColor:    "#a78bfa",
  });

  if (sent) {
    return (
      <div style={{
        width: "100%", height: "100%",
        display: "flex", flexDirection: "column",
        alignItems: "center", justifyContent: "center",
        padding: "32px", gap: "20px",
      }}>
        <div style={{
          width: "52px", height: "52px", borderRadius: "50%",
          border: "1px solid #34d399",
          display: "flex", alignItems: "center", justifyContent: "center",
          fontSize: "22px",
        }}>
          ✓
        </div>
        <p style={{ color: "#34d399", fontFamily: "'Courier New', monospace", fontSize: "14px", letterSpacing: "0.06em" }}>
          message_sent.ok
        </p>
        <p style={{ color: "#444", fontFamily: "'Courier New', monospace", fontSize: "12px", textAlign: "center" }}>
          {CONTACT_INFO.response}
        </p>
        <button
          onClick={() => { setSent(false); setForm({ name: "", email: "", company: "", subject: "", message: "" }); }}
          style={{
            marginTop: "8px", background: "transparent",
            border: "1px solid #2a2a2a", color: "#555",
            padding: "8px 20px", borderRadius: "5px",
            fontFamily: "'Courier New', monospace", fontSize: "11px",
            cursor: "pointer", letterSpacing: "0.06em", transition: "all 0.15s",
          }}
          onMouseEnter={(e) => { e.currentTarget.style.borderColor = "#555"; e.currentTarget.style.color = "#ccc"; }}
          onMouseLeave={(e) => { e.currentTarget.style.borderColor = "#2a2a2a"; e.currentTarget.style.color = "#555"; }}
        >
          send another →
        </button>
      </div>
    );
  }

  return (
    <div style={{
      width: "100%", height: "100%",
      overflowY: "auto", WebkitOverflowScrolling: "touch",
      padding: "clamp(16px, 3vw, 28px)",
      display: "flex", flexDirection: "column", gap: "clamp(20px, 4vh, 32px)",
    }}>
      <p style={{ color: "#ffffff", fontSize: "10px", fontFamily: "'Courier New', monospace", letterSpacing: "0.1em", textTransform: "uppercase" }}>
        Contact — contact.form
      </p>

      {/* Contact meta */}
      <div style={{ display: "flex", flexWrap: "wrap", gap: "clamp(12px, 2vw, 24px)" }}>
        {[
          { label: "email",    value: CONTACT_INFO.email    },
          { label: "location", value: CONTACT_INFO.location },
          { label: "response", value: CONTACT_INFO.response },
        ].map(({ label, value }) => (
          <div key={label}>
            <p style={{ color: "#2e2e2e", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.12em", textTransform: "uppercase", marginBottom: "3px" }}>
              {label}
            </p>
            <p style={{ color: "#666", fontSize: "clamp(10px, 1.3vw, 12px)", fontFamily: "'Courier New', monospace" }}>
              {value}
            </p>
          </div>
        ))}
      </div>

      <div style={{ height: "1px", background: "#1e1e1e" }} />

      {/* Form */}
      <div style={{ display: "flex", flexDirection: "column", gap: "clamp(14px, 2.5vh, 22px)" }}>
        {/* Text fields */}
        <div style={{ display: "grid", gridTemplateColumns: "repeat(auto-fill, minmax(180px, 1fr))", gap: "clamp(14px, 2vw, 22px)" }}>
          {FIELDS.map(({ id, label, type, placeholder, required }) => (
            <div key={id}>
              <label style={{ display: "block", color: errors[id] ? "#f87171" : "#3a3a3a", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.12em", textTransform: "uppercase", marginBottom: "6px" }}>
                {label}{required ? " *" : ""}
                {errors[id] && <span style={{ marginLeft: "8px", color: "#f87171" }}>— {errors[id]}</span>}
              </label>
              <input
                type={type}
                placeholder={placeholder}
                value={form[id]}
                onChange={(e) => { setForm((f) => ({ ...f, [id]: e.target.value })); if (errors[id]) setErrors((er) => ({ ...er, [id]: null })); }}
                onFocus={() => setFocused(id)}
                onBlur={() => setFocused(null)}
                style={inputStyle(id)}
              />
            </div>
          ))}
        </div>

        {/* Message */}
        <div>
          <label style={{ display: "block", color: errors.message ? "#f87171" : "#3a3a3a", fontSize: "9px", fontFamily: "'Courier New', monospace", letterSpacing: "0.12em", textTransform: "uppercase", marginBottom: "6px" }}>
            message *{errors.message && <span style={{ marginLeft: "8px", color: "#f87171" }}>— required</span>}
          </label>
          <textarea
            placeholder="Tell us about your project, your problem, or what you need..."
            value={form.message}
            onChange={(e) => { setForm((f) => ({ ...f, message: e.target.value })); if (errors.message) setErrors((er) => ({ ...er, message: null })); }}
            onFocus={() => setFocused("message")}
            onBlur={() => setFocused(null)}
            rows={4}
            style={{
              ...inputStyle("message"),
              resize:    "none",
              display:   "block",
              lineHeight: 1.8,
            }}
          />
        </div>

        {/* Submit */}
        <div style={{ display: "flex", alignItems: "center", gap: "16px", flexWrap: "wrap" }}>
          <button
            onClick={handleSubmit}
            disabled={sending}
            style={{
              background:    sending ? "transparent" : "#a78bfa18",
              border:        "1px solid #a78bfa55",
              color:         sending ? "#555" : "#a78bfa",
              padding:       "10px 24px",
              borderRadius:  "6px",
              fontFamily:    "'Courier New', monospace",
              fontSize:      "12px",
              letterSpacing: "0.06em",
              cursor:        sending ? "default" : "pointer",
              transition:    "all 0.18s",
              WebkitTapHighlightColor: "transparent",
            }}
            onMouseEnter={(e) => { if (!sending) { e.currentTarget.style.background = "#a78bfa30"; e.currentTarget.style.borderColor = "#a78bfa"; } }}
            onMouseLeave={(e) => { e.currentTarget.style.background = sending ? "transparent" : "#a78bfa18"; e.currentTarget.style.borderColor = "#a78bfa55"; }}
          >
            {sending ? "sending..." : "send_message →"}
          </button>

          <p style={{ color: "#282828", fontSize: "10px", fontFamily: "'Courier New', monospace", letterSpacing: "0.05em" }}>
            * required fields
          </p>
        </div>
      </div>
    </div>
  );
};

export default Contact;