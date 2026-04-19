# PhoneStore - متجر الهواتف الذكية

مشروع Laravel لعرض وإدارة عروض الهواتف الذكية.

---

## متطلبات التشغيل

- PHP >= 8.0
- Composer
- MySQL
- Node.js & npm

---

## خطوات التثبيت على جهاز جديد

### 1. استنساخ المشروع
```bash
git clone https://github.com/MahmoudAlser/phone-store.git
cd phone-store
```

### 2. تثبيت الحزم
```bash
composer install
```

### 3. إعداد ملف البيئة
```bash
cp .env.example .env
php artisan key:generate
```

### 4. إعداد قاعدة البيانات
في ملف `.env` عدّل:
```
DB_DATABASE=phone_store
DB_USERNAME=root
DB_PASSWORD=
```

### 5. تشغيل الـ Migrations والـ Seeders
```bash
php artisan migrate --seed
```

هذا سيُنشئ جميع الجداول ويضيف:
- التصنيفات الافتراضية
- مستخدم admin (email: admin@admin.com / password: 090909)

### 6. رابط مجلد التخزين
```bash
php artisan storage:link
```

### 7. تشغيل الموقع
```bash
php artisan serve
```

ثم افتح: http://localhost:8000

---

## بيانات الدخول

| الدور | الإيميل | كلمة المرور |
|-------|---------|-------------|
| Admin | admin@admin.com | 090909 |

---

## الميزات

- صفحة رئيسية مع carousel
- عرض البوستات مع pagination
- نظام تسجيل دخول وتسجيل
- رفع بوست مع صورة (للـ admin فقط)
- نظام تعليقات على كل بوست
- تصميم RTL عربي احترافي
