## DataBase Final Project

#### 系統架構
![image](https://github.com/Station9586/Django_Final/blob/main/System_structure.png)

#### 網頁部分
主要以**template模板**的形式來完成

#### 主要功能
1. **排版**：手刻 CSS 檔案
2. **資料庫**：存在 phpmyadmin


   資料表內容：![image](https://github.com/Station9586/Django_Final/blob/main/DB_plot.png)
3. **登入介面**
    - Login table (\<form\>)
    - 管理者帳號登入到後台資料庫
    - Register table (\<form\>)
4. **messages**
    - 單純的CSS去做樣式變化

**Session存登入資訊才能瀏覽以下功能**

5. **首頁**
    - image是圖書館截圖的
6. **所有預約資訊**
    - 資料庫叫資料用while迴圈印出來
    - 刪除按鈕: JavaScript
    - 篩選功能: Javascript
7. **新增預約**
    - 預約表格用form
8. **修改預約**
    - 一般table去做修改
9. **密碼修改 / 刪除帳號**
    - 一般table去修改
    - 刪除是判斷密碼有沒有對才能進行刪除
10. **登出**
    - 回傳到登入頁面且清空Session


> 少數有認真做的...
