# project_sm

เป็นโปรเจค mini สำหรับวิชา Web Application Program Development และ Business System Software Development


## Author
+ [Saran Saeeung](https://github.com/Mickey4527)
+ [Thanawat Jatntawong](https://github.com/thanawat88)

## Roadmap

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
