# CI4

## 1. Cấu trúc dự án

- app/: chứa toàn bộ mã nguồn PHP

    - Config/: Nơi cấu hình toàn bộ hệ thống (Kết nối db, cài đặt routes/định tuyến, cấu hình bảo mật,...)
    - Controllers/: nơi nhận các yêu cầu (request) từ frontend gửi lên, xử lý logic, điều hướng dữ liệu
    - Models/: nơi định nghĩa cấu trúc dữ liệu, các câu lệnh truy vấn (sql) để nói chuyện với mysql
    - Filters/: đây chính là các middleware: cửa kiểm tra xem user đăng nhập chưa, token có hợp lệ không trước khi request đi vào controller
    - Views/: nơi chứa giao diện html/css
    - Database/: nơi quản lý db bằng code: migration, seeds
    - Helpers/: viết các hàm độc lập, dùng đi dùng lại ở nhiều nơi trong dự án
    - Langague/: nơi ghi các file dịch ngôn ngữ
    - Libraries/: nơi chứa các thư viện tự viết, khác Helpers là các hàm rời rạc, Libraries là nơi chúng ta tự định nghĩa các Class (Lớp) xử lý một cụm nghiệp vụ lớn, có cấu trúc hướng đối tượng (OOP) rõ ràng.
    - ThirdParty/: Nơi chứa code của bên thứ ba - dạng thủ công (ném file script của thư viện bên thứ 3 vào đây để dùng)
- public/: chứa file được công khai ra ngoài internet
- writable/: nới lưu trữ file mà CI4 ghi lại trong quá trình chạy
- vender/: do composer quản lý, chứa mã nguồn cốt lõi của ci4 và các thư viện bên thứ 3 mình cài vào
- tests/: nơi chứa các file code unit test
- env: file cấu hình môi trường
- composer.json: giống package.json
- spark: là công cụ dòng lệnh

## Một số lệnh cơ bản

```sh
# chay ung dung
php spark serve

# tao file migration
php spark make:migration CreateVocabulariesTable

# chay migration
php spark migrate

# tao file seeds du lieu
php spark make:seeder VocabSeeder

# do du lieu vao db
php spark db:seed VocabSeeder

```

## Một số lưu ý

- Không nên cho backend connect MySQL bằng tài khoản root, như vậy nếu MySQL chứa nhiều DB, khi gặp sự cố có thể sẽ mất hết các DB, chỉ cho log user bị giới hạn quyền, giới hạn truy cập DB thôi, sự cố xảy ra chỉ ảnh hưởng trong phạm vi nhỏ
