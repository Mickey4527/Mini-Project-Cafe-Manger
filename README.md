# Seed

เป็นโปรเจค mini สำหรับวิชา Web Application Program Development และ Business System Software Development


## Author
+ [Saran Saeeung](https://github.com/Mickey4527)
+ [Thanawat Jatntawong](https://github.com/thanawat88)

## DataForProject
+ [Excel ข้อมูล, ตาราง, รูปประกอบ](https://mailrmuttac-my.sharepoint.com/:x:/g/personal/1164109051311_mail_rmutt_ac_th/EeM59Yh529RClZh2KcGH-RwBCQoQnuh4ZBjJDD42kF1ZqQ?e=K02Clp&nav=MTVfe0UzMzI3RjA5LUE5NTctNDY0RS05NEVCLUNFRjM4ODBFQjg0OH0)
+ [MsWord เล่มโครงงาน](https://mailrmuttac-my.sharepoint.com/:w:/g/personal/1164109050834_mail_rmutt_ac_th/EVoxOPICQLNOlR3Os3zXfJUB_4y-54cq6vF33k4R58UFgQ?e=Y0dhyo)

## Roadmap

+ 🕑 หน้าล็อกอิน
+ 🕑 หน้าลงทะเบียนเข้าใช้งาน

+ 🕑 หน้าจัดการบัญชีเฉพาะร้าน
+ ❌ หน้าตั้งค่าร้าน
+ ❌ หน้าคิดเงิน
+ ❌ หน้าจัดการรายการสินค้า

## What's new in v.0.0.1?
Code name **popcorn**
+ หน้าล็อกอินที่ยังทำอะไรไม่ได้ 🎊


## คำอธิบาย function

### htmlHeader( _string_ $title, _string_ $style = null, _string_ $BodyClass = null, _string_ $lang = null)

**คำอธิบาย** ส่งค่าที่จำเป็นของ header HTML เช่น ภาษาของหน้า, meta, title, css link และ body ใน page นั้น จำเป็นต้องมีชื่อหน้า (title) เมื่อเรียกใช้ฟังก์ชั่น
+ $style - **ค่าเริ่มต้น คือ null** คำสั่ง css ที่ต้องการเรียกใช้ในหน้าที่มีการเรียกใช้คำสั่ง htmlHeader
+ $BodyClass - **ค่าเริ่มต้น คือ null** class ของ body ที่ต้องการกำหนด
+ $lang - **ค่าเริ่มต้น คือ null** ภาษาของหน้า
  
**Return**

ไม่มีการ return ใด แสดงค่าในรูปแบบ HTML

**วิธีใช้**
```php
htmlHeader('ลงชื่อเข้าใช้งาน');
```

### htmlFooter(_string_ $js = null)
**คำอธิบาย** ส่งค่าที่จำเป็นของ footer HTML เช่น script ที่ต้องการเรียกใช้ในหน้าที่มีการเรียกใช้คำสั่ง htmlFooter
+ $js - **ค่าเริ่มต้น คือ null** คำสั่ง script ที่ต้องการเรียกใช้ในหน้าที่มีการเรียกใช้คำสั่ง htmlFooter
**Return**

ไม่มีการ return ใด แสดงค่าในรูปแบบ HTML

**วิธีใช้**
```php
htmlFooter();
```
