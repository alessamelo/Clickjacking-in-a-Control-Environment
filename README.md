# 🍓 Clickjacking Demo using Dual AWS EC2 Instances

*A controlled cybersecurity experiment for the Network Attack & Defense Lab*

---

## Overview

This project demonstrates a full **Clickjacking (UI Redressing) attack** using **two AWS EC2 servers**:

### ✔ Victim Server (AWS #1)

Hosts the vulnerable banking interface:

* login.html
* confirm.html
* victim.css
* log.php

### ✔ Attacker Server (AWS #2)

Hosts the malicious rewards page:

* attacker.html
* attacker.css
* hidden iframe loading real victim page

Both servers have **public IPs**, enabling:

* real-world behavior
* easy demonstration
* live remote presentation
* reproduction

This setup closely follows principles from the SEED Clickjacking Lab  and the project guidelines .


## 🍓 System Architecture

```
                        ┌──────────────────────────────┐
                        │  AWS EC2 Instance #2          │
                        │  (Attacker Server)            │
                        │  attacker.html + iframe       │
                        │  Public IP: X.X.X.X           │
                        └───────────────┬───────────────┘
                                        │ Loads hidden iframe
                                        ▼
                        ┌──────────────────────────────┐
                        │  AWS EC2 Instance #1          │
                        │  (Victim Server)              │
                        │  Banking UI (login+confirm)   │
                        │  Public IP: Y.Y.Y.Y           │
                        └──────────────────────────────┘
```

### Why this architecture?

✔ Makes DEMO **fully cloud-based**
✔ Works from ANY browser (Windows, Mac, phone, professor PC)
✔ Easier live demonstration
✔ No local dependencies
✔ Realistic: attacker often exists on their own server

---


## 🍓 Victim Server (AWS EC2 #1)

Deploy these files:

* login.html 
* confirm.html 
* victim.css 
* log.php

Ensure the server has:

* Port 80 open
* Apache installed
* **NO security headers enabled** (vulnerable for demo)

---

## 🍓 Attacker Server (AWS EC2 #2)

Deploy:

* attacker.html 
* attacker.css 

Hidden iframe loads the victim:

```html
<iframe id="victim-frame"
        src="http://<Victim-Public-IP>/confirm.html?user=XXXX&amount=YYYY">
</iframe>
```

Attacker interface remains visible, iframe remains invisible.

---

## 🍓 Updated Full Workflow of the Attack

1️. User opens attacker page (AWS EC2 #2)
2️. Fake “CLAIM PRIZE” button displayed
3️. Attacker page loads victim confirm page invisibly via iframe
4️. User clicks
5️. Click passes through to victim page
6️. Victim server (AWS #1) executes transfer
7️. `log.php` logs the event
8️. User sees only the attacker interface

This demonstrates **real-world clickjacking in the cloud**.

---

## 🍓 Mitigation

On the **victim server** (AWS #1), enabling:

```apache
Header set X-Frame-Options "DENY"
Header set Content-Security-Policy "frame-ancestors 'none'"
```

prevents embedding → attacker iframe breaks → attack fails.

---



