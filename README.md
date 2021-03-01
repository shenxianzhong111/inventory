# 森洽进销存系统

#### 介绍
使用Thinkphp5 + BUI实现在一套进销存系统，数据库Mysql，主要功能包括产品生产加工，出库，入库，财务，Excel导出，打印，图表，产品图片等功能

#### 更新说明

**20200417：**  
系统菜单有变动，执行sqls/tb_system_menu 可以和演示版本保持一致  
执行sqls/demo_ims_1.2 修复一些数据字段不严谨的bug  

**20200413：**  
升级权限 验证规则为菜单方式，什么意思 呢？   
就是用户关联用户组、用户组关联系统菜单、系统菜单rules字段保存rule规则   
给用户组分配权限 的时间，指定这个用户组关联哪些菜单。  
但是前提条件是，系统菜单里 已经预先配置好了 相应的权限规则 。  
在原有数据库的基本上 执行 demo_ims_1.1.sql 升级数据库  
菜单也要更新一下，请参照demo中的菜单或 按照你自己喜欢的方式。。  
祝用的开心~~   

**2020/12/11:**  

1. 放弃使用阿里图标，使用bootstrap自带的图标
2. 为产品类型product_type新建了一张表，而非之前使用config的方式
3. 修复数据备份insert语句当字段为null时候的bug
4. 控制台首页改版 以 更加符合业务需要
5. 系统菜单增加了导入导出功能
6. 库存查询模块，增加了数据按库存和识别码排序
7. 产品查看模块，增加报废记录和生产消耗记录，并优化页面排版
8. 优化了install模块，新用户务必使用install方式安装 ，重新安装请删除install.lock文件


**2021/01/30：**

1. 使用了 requirejs优化js的加载与依赖
2. 删除原来的*zTree*重型插件，换成了更轻便的yntree插件进行权限配置
3. 删除原来的toastr提示插件，统一换成了layer插件
4. 带分页的列表页面，增加了page_size选项，用于自定义每页显示多少条
5. 会员列表增加会员查看页面
6. CLodopPrint_Setup_for_Win32NT.zip上传到了public目录，当新用户没有安装的时候可以直接点击下载



#### 软件架构
基于以下技术开发

1. BUI
2. Bootstrap3
3. jquery
4. Auth权限控制
5. AutoComplete
6. cxselect联动菜单
7. php-Excel库
8. C-Lodop网页打印组件
9. thinkphp5.0.24
10. datetimepicker

#### 功能清单

1. 生产管理
2. 入库、出库
3. 库存查询、调拨、报废
4. 财务管理
5. 系统用户权限访问控制
6. 仓库、供应商、会员管理


#### 安装教程

1. 下载代码到本地目录
2. 如果放在域名下运行，请将网站目录指向到public目录
3. 根据你当前的运行环境**设置伪静态**，**开启path_info**
4. 访问 http://你的域名/install/ 进行安装 


#### 使用说明

1. 系统超级管理员账号只有一个，拥有所有菜单权限
2. 系统架构清晰，数据库设计合理
3. 欢迎进行二次开发
4. 如果对系统有任何疑问，欢迎加入ＱＱ交流群：688920281 进行交流


#### 演示地址
http://www.senqia.com/ 账号：superadmin 密码：123456  

![思维导图](https://images.gitee.com/uploads/images/2020/0106/155501_3f8c1ed8_593571.png "森洽进销存.png")
![系统登录](https://images.gitee.com/uploads/images/2019/0528/122631_a08f6fd5_593571.png "login.png")
![生产加工](https://images.gitee.com/uploads/images/2019/0528/122656_8a1a46ec_593571.png "product_build.png")
![出库](https://images.gitee.com/uploads/images/2019/0528/122704_156f6554_593571.png "sales.png")
![仓储配置](https://images.gitee.com/uploads/images/2019/0528/122711_e9f82619_593571.png "warehouse.png")