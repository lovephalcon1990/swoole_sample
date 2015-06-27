### 简单的tcp聊天室
**需要swoole版本>=1.7.18**

* 首先运行 server.php
* client.php 只能接收消息,不能发送
* client_sync.php 使用同步方式连接,并且另启一个子进程读取标准输入,可以实时发消息给服务器

