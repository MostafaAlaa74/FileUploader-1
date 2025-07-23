# FileUploader 📁

A Laravel-based web application for uploading, managing, and deleting files with role-based access and user notifications.

---

## 🚀 Features

- ✅ Upload files with unique names
- ✅ Store files securely in `public/files`
- ✅ Display files based on user role:
  - **Admins** can view **all** files and delete **any** file 
  - **Users** can view **only their own** files and delete **only thier own** file 
- ✅ Delete files (with authorization check)
- ✅ Send notifications (email + database) on file upload
- ✅ Uses Laravel **Policies** and **Gates** for access control

---

## 🛠️ Tech Stack

- **Laravel 12**
- **Notifications** (Mail & Database channels)
- **Laravel Policies** for Authorization
- **Validation Requests** (`StoreFileRequest`)
- **Laravel Storage System** for file handling
- **Blade Templating Engine**

---

## 🧠 How It Works

### File Upload
Users can upload files through a form. The system:
- Generates a unique filename
- Stores the file in `public/files`
- Sends a notification to the user (via `Reminder` class)

### Role-based File Listing
- Uses `Gate::allows('viewAll', File::class)` in the controller
- Admins see all files, users see only their uploads

### Authorization (Policies & Gates)
- Gates are defined in `AuthServiceProvider`
- Example:
  ```php
  Gate::define('delete-file', function (User $user, File $file) {
      return $user->id === $file->user_id;
  });
