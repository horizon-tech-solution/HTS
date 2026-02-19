import { useState } from "react";
import FolderIcon from "../components/FolderIcon";
import FileIcon   from "../components/FileIcon";
import Homi       from "../projects/Homi";

// ─── Projects registry ─────────────────────────────────────────────────────────
// Add new projects here. Each gets a folder. Files inside open a component.
const PROJECTS = [
  {
    id:     "homi",
    label:  "Homi",
    color:  "#34d399",
    status: "live",
    files: [
      {
        id:        "homi-project",
        label:     "homi.project",
        color:     "#34d399",
        component: Homi,
      },
    ],
  },
  // Add more projects:
  // {
  //   id:     "next-project",
  //   label:  "ProjectName",
  //   color:  "#60a5fa",
  //   status: "wip",
  //   files: [{ id: "...", label: "project.file", color: "#60a5fa", component: YourPage }],
  // },
];

const STATUS_COLOR = {
  live:    "#34d399",
  wip:     "#fbbf24",
  concept: "#a78bfa",
};

// ─── Projects ──────────────────────────────────────────────────────────────────
const Projects = () => {
  const [openFolder, setOpenFolder] = useState(null);
  const [selected,   setSelected]   = useState(null);
  const [openFile,   setOpenFile]   = useState(null);

  const currentProject = PROJECTS.find((p) => p.id === openFolder);

  // ── Root: project folders ──
  if (!openFile && !openFolder) {
    return (
      <div
        style={{ width: "100%", minHeight: "100%", overflowY: "auto", WebkitOverflowScrolling: "touch", padding: "clamp(16px,3vw,28px)" }}
        onClick={() => setSelected(null)}
      >
        <p style={{ color: "#333", fontSize: "10px", fontFamily: "'Courier New', monospace", letterSpacing: "0.1em", marginBottom: "clamp(16px,3vh,24px)", textTransform: "uppercase" }}>
          Projects — {PROJECTS.length} folder{PROJECTS.length !== 1 ? "s" : ""}
        </p>

        <div style={{ display: "grid", gridTemplateColumns: "repeat(auto-fill, minmax(110px, 1fr))", gap: "8px" }}>
          {PROJECTS.map((proj) => (
            <div key={proj.id} style={{ position: "relative" }}>
              {/* Status badge */}
              <div style={{
                position:      "absolute", top: "6px", right: "6px", zIndex: 2,
                background:    STATUS_COLOR[proj.status] + "22",
                border:        `1px solid ${STATUS_COLOR[proj.status]}55`,
                color:         STATUS_COLOR[proj.status],
                fontSize:      "8px", fontFamily: "'Courier New', monospace",
                letterSpacing: "0.1em", padding: "2px 6px", borderRadius: "20px",
                textTransform: "uppercase", pointerEvents: "none",
              }}>
                {proj.status}
              </div>

              <FolderIcon
                color={proj.color}
                size={76}
                label={proj.label}
                selected={selected === proj.id}
                onClick={(e) => { e.stopPropagation(); setOpenFolder(proj.id); setSelected(null); }}
              />
            </div>
          ))}
        </div>
      </div>
    );
  }

  // ── Inside a project folder ──
  if (!openFile && openFolder && currentProject) {
    return (
      <div
        style={{ width: "100%", minHeight: "100%", overflowY: "auto", WebkitOverflowScrolling: "touch", padding: "clamp(16px,3vw,28px)" }}
        onClick={() => setSelected(null)}
      >
        {/* Back nav */}
        <div style={{ display: "flex", alignItems: "center", gap: "10px", marginBottom: "clamp(16px,3vh,24px)" }}>
          <button
            onClick={() => { setOpenFolder(null); setSelected(null); }}
            style={{
              background: "transparent", border: "none", color: "#555",
              fontFamily: "'Courier New', monospace", fontSize: "11px",
              letterSpacing: "0.06em", cursor: "pointer", padding: "0",
              transition: "color 0.15s", WebkitTapHighlightColor: "transparent",
            }}
            onMouseEnter={(e) => (e.currentTarget.style.color = "#ccc")}
            onMouseLeave={(e) => (e.currentTarget.style.color = "#555")}
          >
            ← projects
          </button>
          <span style={{ color: "#2a2a2a", fontFamily: "'Courier New', monospace", fontSize: "11px" }}>/</span>
          <span style={{ color: "#888", fontFamily: "'Courier New', monospace", fontSize: "11px", letterSpacing: "0.04em" }}>
            {currentProject.label}
          </span>
        </div>

        <p style={{ color: "#333", fontSize: "10px", fontFamily: "'Courier New', monospace", letterSpacing: "0.1em", marginBottom: "clamp(14px,2.5vh,20px)", textTransform: "uppercase" }}>
          {currentProject.label} — {currentProject.files.length} file{currentProject.files.length !== 1 ? "s" : ""}
        </p>

        <div style={{ display: "flex", gap: "12px", flexWrap: "wrap" }}>
          {currentProject.files.map((file) => (
            <FileIcon
              key={file.id}
              label={file.label}
              size={76}
              color={file.color}
              selected={selected === file.id}
              onClick={(e) => { e.stopPropagation(); setOpenFile(file); }}
            />
          ))}
        </div>
      </div>
    );
  }

  // ── Fullscreen file viewer ──
  if (openFile) {
    const Component = openFile.component;
    return <Component onClose={() => setOpenFile(null)} />;
  }

  return null;
};

export default Projects;