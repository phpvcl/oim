###  功能
  
  目前完成了基础通信、上下线通知、离线消息、发送图片、发送文件、聊天记录。访客端的用户体验还不是很友好


###  网站目录  
./application/api  接口  
./application/client 访客端与客服端  
./application/server 服务端
./application/admin 没做，就客服管理而已

###  配置说明  
数据库这些配置直接改./config/database.php就好了
服务端地址配置是与当前网站一致，如网站路径配置为：http://www.oim.com/
那么服务端地址就是：ws://www.oim.com:9501


###  其他注意

注意$server->connections会话连接池，需要安装pcre组件的支持，并重新编译swoole，不然是空值。


![图片1](https://github.com/phpvcl/oim/blob/master/readme/01.png)  

![图片2](https://github.com/phpvcl/oim/blob/master/readme/02.png)  

![图片4](https://github.com/phpvcl/oim/blob/master/readme/04.png)  

![图片3](https://github.com/phpvcl/oim/blob/master/readme/03.png)  
