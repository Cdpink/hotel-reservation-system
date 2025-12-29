/_ ===============================
RESET / BASE
================================ _/

- {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  }

body {
font-family: Arial, Helvetica, sans-serif;
font-size: 16px;
line-height: 1.5;
color: #212529;
background-color: #ffffff;
}

/_ ===============================
LAYOUT
================================ _/
.container {
width: 90%;
margin: auto;
}

.flex { display: flex; }
.block { display: block; }
.inline { display: inline; }

.items-start { align-items: flex-start; }
.items-center { align-items: center; }
.items-end { align-items: flex-end; }

.justify-start { justify-content: flex-start; }
.justify-center { justify-content: center; }
.justify-between { justify-content: space-between; }
.justify-end { justify-content: flex-end; }

.row { display: flex; }
.col { flex: 1; }
.col-2 { flex: 2; }
.col-3 { flex: 3; }

/_ ===============================
POSITION
================================ _/
.position-static { position: static; }
.position-relative { position: relative; }
.position-absolute { position: absolute; }
.position-fixed { position: fixed; }
.position-sticky { position: sticky; }

.top-0 { top: 0; }
.bottom-0 { bottom: 0; }
.start-0 { left: 0; }
.end-0 { right: 0; }

.top-50 { top: 50%; }
.start-50 { left: 50%; }

.translate-middle {
transform: translate(-50%, -50%);
}

.z-1 { z-index: 1; }
.z-10 { z-index: 10; }
.z-100 { z-index: 100; }

/_ ===============================
WIDTH
================================ _/
.w-50 { width: 50%; }
.w-70 { width: 70%; }
.w-80 { width: 80%; }
.w-100 { width: 100%; }

.w-50px { width: 50px; }
.w-70px { width: 70px; }
.w-80px { width: 80px; }
.w-100px { width: 100px; }

/_ ===============================
HEIGHT
================================ _/
.h-50 { height: 50%; }
.h-70 { height: 70%; }
.h-80 { height: 80%; }
.h-100 { height: 100%; }

.h-50px { height: 50px; }
.h-70px { height: 70px; }
.h-80px { height: 80px; }
.h-100px { height: 100px; }

/_ ===============================
SPACING
================================ _/
.p-1 { padding: 8px; }
.p-2 { padding: 16px; }
.p-3 { padding: 24px; }

.m-1 { margin: 8px; }
.m-2 { margin: 16px; }
.m-3 { margin: 24px; }

/_ ===============================
TEXT & FONT
================================ _/
.font-sans { font-family: Arial, Helvetica, sans-serif; }
.font-serif { font-family: "Times New Roman", serif; }
.font-mono { font-family: Consolas, monospace; }

.fs-1 { font-size: 2.5rem; }
.fs-2 { font-size: 2rem; }
.fs-3 { font-size: 1.5rem; }
.fs-4 { font-size: 1.25rem; }
.fs-5 { font-size: 1rem; }
.fs-6 { font-size: 0.875rem; }

.fw-light { font-weight: 300; }
.fw-normal { font-weight: 400; }
.fw-bold { font-weight: 700; }

.text-start { text-align: left; }
.text-center { text-align: center; }
.text-end { text-align: right; }

.text-uppercase { text-transform: uppercase; }
.text-lowercase { text-transform: lowercase; }
.text-capitalize { text-transform: capitalize; }

.text-italic { font-style: italic; }

.lh-1 { line-height: 1; }
.lh-sm { line-height: 1.25; }
.lh-base { line-height: 1.5; }
.lh-lg { line-height: 2; }

.text-truncate {
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
}

/_ ===============================
TEXT COLORS
================================ _/
.text-primary { color: #0d6efd; }
.text-secondary { color: #6c757d; }
.text-success { color: #198754; }
.text-danger { color: #dc3545; }
.text-warning { color: #ffc107; }
.text-info { color: #0dcaf0; }
.text-muted { color: #6c757d; }
.text-dark { color: #212529; }
.text-light { color: #f8f9fa; }
.text-white { color: #ffffff; }

/_ ===============================
BACKGROUND COLORS
================================ _/
.bg-primary { background-color: #0d6efd; }
.bg-secondary { background-color: #6c757d; }
.bg-success { background-color: #198754; }
.bg-danger { background-color: #dc3545; }
.bg-warning { background-color: #ffc107; }
.bg-info { background-color: #0dcaf0; }
.bg-light { background-color: #f8f9fa; }
.bg-dark { background-color: #212529; }
.bg-white { background-color: #ffffff; }

/_ ===============================
BORDER
================================ _/
.border { border: 1px solid #dee2e6; }

.border-primary { border-color: #0d6efd; }
.border-success { border-color: #384740ff; }
.border-danger { border-color: #dc3545; }
.border-warning { border-color: #ffc107; }
.border-dark { border-color: #212529; }

/_ ===============================
BUTTONS
================================ _/
.btn {
padding: 10px 16px;
border: none;
border-radius: 5px;
cursor: pointer;
font-size: 1rem;
}

.btn-primary {
background-color: #0d6efd;
color: #ffffff;
}

.btn-success {
background-color: #198754;
color: #ffffff;
}

.btn-danger {
background-color: #dc3545;
color: #ffffff;
}

/_ ===============================
CARD
================================ _/
.card {
border: 1px solid #ddd;
border-radius: 8px;
padding: 16px;
background-color: #ffffff;
}

/_ ===============================
SHADOW
================================ _/
.shadow-sm {
box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.shadow {
box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}
