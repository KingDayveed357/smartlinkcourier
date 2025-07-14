# 📦 Parcel Management System

A simple and efficient **Parcel Management System** with an **Admin Dashboard** for tracking parcels using **Parcel IDs** and **QR Codes**. Built with **PHP** and **MySQL**, this system allows administrators to add, update, and track parcels in real-time.

---

## 🚀 Features

- ✅ Add new parcels with unique Parcel IDs
- ✅ Generate and scan QR codes for each parcel
- ✅ Track parcel status and history
- ✅ Admin dashboard for managing all parcels
- ✅ Search parcels by ID or recipient
- ✅ Authentication system for admin access
- ✅ Clean, responsive UI for desktop and mobile

---

## 🛠️ Tech Stack

- **Backend**: PHP (Vanilla)
- **Database**: MySQL
- **QR Code Generator**: PHP QR Code Library
- **Frontend**: HTML5, CSS3, JavaScript (optional Bootstrap)

---


---

## ⚙️ Installation & Setup

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/parcel-management.git
   cd parcel-management
Set up the database

Import database.sql (provided in the project root or /database folder) into your MySQL server.

Update config/db.php with your database credentials.

Run the project

Make sure you have a local server (e.g., XAMPP, WAMP, Laragon) running.

Access the app at http://localhost/parcel-management/public/index.php

Login to Admin Dashboard

Default Admin credentials:

makefile
Copy
Edit
Email: admin@example.com
Password: admin123
🧪 How QR Code Tracking Works
Each parcel created in the system is assigned a Parcel ID. A QR code is automatically generated for that ID, which can be:

Printed and attached to the parcel

Scanned by delivery personnel or recipients to track parcel status

Used to quickly retrieve parcel data via the public tracking page

🧑‍💻 Future Improvements
📱 Add mobile-friendly UI and PWA support

📊 Add reporting and analytics on parcels

📦 Integrate real-time tracking updates

✉️ Email/SMS notifications to recipients

🔐 Role-based access (admin, manager, staff)

📄 License
This project is open-source under the MIT License.

🤝 Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change or improve.

✉️ Contact
For questions or collaboration:
David Aniago
📧 davidaniago@gmail.com
🌐 https://david-aniago-ai.vercel.app/
