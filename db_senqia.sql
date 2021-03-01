/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : db_senqia

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-02-28 16:47:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `tb_auth_group`;
CREATE TABLE `tb_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) DEFAULT '',
  `status` tinyint(1) DEFAULT '1',
  `rules` text,
  `menus` text,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_auth_group
-- ----------------------------

-- ----------------------------
-- Table structure for tb_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `tb_auth_group_access`;
CREATE TABLE `tb_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_auth_group_access
-- ----------------------------

-- ----------------------------
-- Table structure for tb_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `tb_auth_rule`;
CREATE TABLE `tb_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `group` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_auth_rule
-- ----------------------------
INSERT INTO `tb_auth_rule` VALUES ('1', '0', 'admin/admin/listorders', '排序', '1', '1', '', '后台');
INSERT INTO `tb_auth_rule` VALUES ('2', '0', 'admin/configure/product_look', '产品查看', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('3', '0', 'admin/configure/product', '产品管理', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('4', '0', 'admin/configure/product_add', '产品添加', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('5', '0', 'admin/configure/product_edit', '产品修改', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('6', '0', 'admin/configure/product_del', '产品删除', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('7', '0', 'admin/configure/express', '快递管理', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('8', '0', 'admin/configure/express_add', '快递添加', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('9', '0', 'admin/configure/express_edit', '快递编辑', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('10', '0', 'admin/configure/express_delete', '快递删除', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('11', '0', 'admin/configure/unit', '单位管理', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('12', '0', 'admin/configure/unit_add', '单位添加', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('13', '0', 'admin/configure/unit_edit', '单位编辑', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('14', '0', 'admin/configure/unit_delete', '单位删除', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('15', '0', 'admin/configure/product_category', '产品分类', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('16', '0', 'admin/configure/product_category_add', '产品分类新增', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('17', '0', 'admin/configure/product_category_delete', '产品分类删除', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('18', '0', 'admin/configure/product_category_edit', '产品分类修改', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('19', '0', 'admin/configure/warehouse', '仓库管理', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('20', '0', 'admin/configure/warehouse_add', '仓库新增', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('21', '0', 'admin/configure/warehouse_edit', '仓库修改', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('22', '0', 'admin/configure/warehouse_delete', '仓库删除', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('23', '0', 'admin/configure/supplier', '供应商列表', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('24', '0', 'admin/configure/supplier_add', '供应商新增', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('25', '0', 'admin/configure/supplier_edit', '供应商修改', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('26', '0', 'admin/configure/supplier_look', '供应商查看', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('27', '0', 'admin/configure/supplier_delete', '供应商删除', '1', '1', '', '库存配置');
INSERT INTO `tb_auth_rule` VALUES ('28', '0', 'admin/database/export', '备份数据库', '1', '1', '', '数据库');
INSERT INTO `tb_auth_rule` VALUES ('29', '0', 'admin/database/import_list', '还原列表', '1', '1', '', '数据库');
INSERT INTO `tb_auth_rule` VALUES ('30', '0', 'admin/database/export_list', '备份列表', '1', '1', '', '数据库');
INSERT INTO `tb_auth_rule` VALUES ('31', '0', 'admin/database/optimize', '优化表', '1', '1', '', '数据库');
INSERT INTO `tb_auth_rule` VALUES ('32', '0', 'admin/database/repair', '修复表', '1', '1', '', '数据库');
INSERT INTO `tb_auth_rule` VALUES ('33', '0', 'admin/database/del', '删除备份文件', '1', '1', '', '数据库');
INSERT INTO `tb_auth_rule` VALUES ('34', '0', 'admin/database/import', '还原数据库', '1', '1', '', '数据库');
INSERT INTO `tb_auth_rule` VALUES ('35', '0', 'admin/finance/bank', '银行管理', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('36', '0', 'admin/finance/bank_add', '新增银行', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('37', '0', 'admin/finance/bank_delete', '删除银行', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('38', '0', 'admin/finance/bank_edit', '修改银行', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('39', '0', 'admin/finance/category', '财务分类', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('40', '0', 'admin/finance/category_add', '新增财务分类', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('41', '0', 'admin/finance/category_delete', '财务银行分类', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('42', '0', 'admin/finance/category_edit', '修改财务分类', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('43', '0', 'admin/finance/add', '新增财务', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('44', '0', 'admin/finance/query', '账务查询', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('45', '0', 'admin/finance/query_delete', '撤销账单', '1', '1', '', '财务');
INSERT INTO `tb_auth_rule` VALUES ('46', '0', 'admin/production/product_build_undo', '生产撤销', '1', '1', '', '生产');
INSERT INTO `tb_auth_rule` VALUES ('47', '0', 'admin/production/product_build_query', '加工记录', '1', '1', '', '生产');
INSERT INTO `tb_auth_rule` VALUES ('48', '0', 'admin/production/product_build_submit', '产品加工提交', '1', '1', '', '生产');
INSERT INTO `tb_auth_rule` VALUES ('49', '0', 'admin/production/product_build', '产品加工', '1', '1', '', '生产');
INSERT INTO `tb_auth_rule` VALUES ('50', '0', 'admin/production/product_relation', '产品关系', '1', '1', '', '生产');
INSERT INTO `tb_auth_rule` VALUES ('51', '0', 'admin/production/product_relation_edit', '产品关系编辑', '1', '1', '', '生产');
INSERT INTO `tb_auth_rule` VALUES ('52', '0', 'admin/production/product_relation_edit_submit', '产品关联提交', '1', '1', '', '生产');
INSERT INTO `tb_auth_rule` VALUES ('53', '0', 'admin/index/log_clear', '日志删除', '1', '1', '', '控制台');
INSERT INTO `tb_auth_rule` VALUES ('54', '0', 'admin/index/password', '修改自己的密码', '1', '1', '', '控制台');
INSERT INTO `tb_auth_rule` VALUES ('55', '0', 'admin/index/index', '框架页面', '1', '1', '', '控制台');
INSERT INTO `tb_auth_rule` VALUES ('56', '0', 'admin/index/main', '首页', '1', '1', '', '控制台');
INSERT INTO `tb_auth_rule` VALUES ('57', '0', 'admin/index/log', '我的日志', '1', '1', '', '控制台');
INSERT INTO `tb_auth_rule` VALUES ('58', '0', 'admin/member/group_price', '会员组销价管理', '1', '1', '', '会员');
INSERT INTO `tb_auth_rule` VALUES ('59', '0', 'admin/member/index', '会员管理', '1', '1', '', '会员');
INSERT INTO `tb_auth_rule` VALUES ('60', '0', 'admin/member/delete', '删除管理', '1', '1', '', '会员');
INSERT INTO `tb_auth_rule` VALUES ('61', '0', 'admin/member/look', '查看会员', '1', '1', '', '会员');
INSERT INTO `tb_auth_rule` VALUES ('62', '0', 'admin/member/edit', '修改会员', '1', '1', '', '会员');
INSERT INTO `tb_auth_rule` VALUES ('63', '0', 'admin/member/add', '新增会员', '1', '1', '', '会员');
INSERT INTO `tb_auth_rule` VALUES ('64', '0', 'admin/member/group', '会员分组', '1', '1', '', '会员');
INSERT INTO `tb_auth_rule` VALUES ('65', '0', 'admin/member/group_add', '会员分组新增', '1', '1', '', '会员');
INSERT INTO `tb_auth_rule` VALUES ('66', '0', 'admin/member/group_edit', '会员分组修改', '1', '1', '', '会员');
INSERT INTO `tb_auth_rule` VALUES ('67', '0', 'admin/member/group_delete', '会员分组删除', '1', '1', '', '会员');
INSERT INTO `tb_auth_rule` VALUES ('68', '0', 'admin/json/finance_category', '财务分类', '1', '1', '', 'JSON');
INSERT INTO `tb_auth_rule` VALUES ('69', '0', 'admin/json/menu', '菜单', '1', '1', '', 'JSON');
INSERT INTO `tb_auth_rule` VALUES ('70', '0', 'admin/json/city', '城市', '1', '1', '', 'JSON');
INSERT INTO `tb_auth_rule` VALUES ('71', '0', 'admin/json/product', '产品', '1', '1', '', 'JSON');
INSERT INTO `tb_auth_rule` VALUES ('72', '0', 'admin/json/member', '会员', '1', '1', '', 'JSON');
INSERT INTO `tb_auth_rule` VALUES ('73', '0', 'admin/system/auth_group', '信息列表', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('74', '0', 'admin/system/auth_group_add', '添加角色', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('75', '0', 'admin/system/auth_group_edit', '编辑角色', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('76', '0', 'admin/system/auth_group_delete', '删除资源', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('77', '0', 'admin/system/auth_rule', '显示资源列表', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('78', '0', 'admin/system/node_parse', '节点解析', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('79', '0', 'admin/system/node_refresh', '刷新节点', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('80', '0', 'admin/system/user', '列表', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('81', '0', 'admin/system/user_add', '添加用户', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('82', '0', 'admin/system/user_edit', '编辑用户', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('83', '0', 'admin/system/user_delete', '用户删除', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('84', '0', 'admin/system/menu', '菜单列表', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('85', '0', 'admin/system/menu_add', '添加', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('86', '0', 'admin/system/menu_edit', '编辑菜单', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('87', '0', 'admin/system/menu_delete', '删除菜单', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('88', '0', 'admin/system/config', '配置列表', '1', '1', '', '系统');
INSERT INTO `tb_auth_rule` VALUES ('89', '0', 'admin/inventory/storage', '入库', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('90', '0', 'admin/inventory/storage_submit', '入库提交', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('91', '0', 'admin/inventory/storage_undo', '入库撤消', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('92', '0', 'admin/inventory/storage_query', '入库查询', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('93', '0', 'admin/inventory/sales', '出库', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('94', '0', 'admin/inventory/sales_submit', '出库提交', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('95', '0', 'admin/inventory/sales_query', '出库查询', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('96', '0', 'admin/inventory/sales_undo', '产品出库撤消', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('97', '0', 'admin/inventory/sales_returns_query', '退货查询', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('98', '0', 'admin/inventory/sales_returns_add', '出库退货提交', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('99', '0', 'admin/inventory/sales_look', '产品出库查询', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('100', '0', 'admin/inventory/sales_look_info_update', '补充快递信息', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('101', '0', 'admin/inventory/stock_delete', '库存记录删除', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('102', '0', 'admin/inventory/stock_query', '库存查询', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('103', '0', 'admin/inventory/transfer_add', '库存调拨窗口', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('104', '0', 'admin/inventory/transfer_query', '调拨查询', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('105', '0', 'admin/inventory/scrapped_add', '报废窗口', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('106', '0', 'admin/inventory/scrapped_query', '报废查询', '1', '1', '', '库存管理');
INSERT INTO `tb_auth_rule` VALUES ('107', '0', 'admin/prints/orders_view', '出库订单详情', '1', '1', '', '打印');
INSERT INTO `tb_auth_rule` VALUES ('108', '0', 'admin/prints/orders_list', '出库订单列表', '1', '1', '', '打印');
INSERT INTO `tb_auth_rule` VALUES ('109', '0', 'admin/prints/storage_list', '入库查询', '1', '1', '', '打印');
INSERT INTO `tb_auth_rule` VALUES ('110', '0', 'admin/prints/storage_view', '入库查询', '1', '1', '', '打印');
INSERT INTO `tb_auth_rule` VALUES ('111', '0', 'admin/prints/finance_list', '打印账务', '1', '1', '', '打印');
INSERT INTO `tb_auth_rule` VALUES ('112', '0', 'admin/everyone/login', '用户登录', '1', '1', '', '公共');
INSERT INTO `tb_auth_rule` VALUES ('113', '0', 'admin/everyone/logout', '用户登出', '1', '1', '', '公共');

-- ----------------------------
-- Table structure for tb_express
-- ----------------------------
DROP TABLE IF EXISTS `tb_express`;
CREATE TABLE `tb_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_express
-- ----------------------------

-- ----------------------------
-- Table structure for tb_finance_accounts
-- ----------------------------
DROP TABLE IF EXISTS `tb_finance_accounts`;
CREATE TABLE `tb_finance_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL COMMENT '用户',
  `bank_id` int(11) DEFAULT NULL COMMENT '银行',
  `c_id` int(11) DEFAULT NULL COMMENT '分类',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `type` int(11) DEFAULT NULL COMMENT '收入支出类型',
  `money` double(11,2) DEFAULT NULL COMMENT '金额',
  `datetime` int(11) DEFAULT NULL COMMENT '日期时间',
  `attn_id` int(11) DEFAULT NULL COMMENT '经办人',
  `remark` text COMMENT '备注',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账务';

-- ----------------------------
-- Records of tb_finance_accounts
-- ----------------------------

-- ----------------------------
-- Table structure for tb_finance_bank
-- ----------------------------
DROP TABLE IF EXISTS `tb_finance_bank`;
CREATE TABLE `tb_finance_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `money` double(11,2) DEFAULT NULL COMMENT '金额',
  `default` int(1) DEFAULT '0' COMMENT '是否默认',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='财务银行';

-- ----------------------------
-- Records of tb_finance_bank
-- ----------------------------

-- ----------------------------
-- Table structure for tb_finance_category
-- ----------------------------
DROP TABLE IF EXISTS `tb_finance_category`;
CREATE TABLE `tb_finance_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT '0',
  `type` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='产器分类';

-- ----------------------------
-- Records of tb_finance_category
-- ----------------------------
INSERT INTO `tb_finance_category` VALUES ('1', '工资发放', '0', '0', '1');
INSERT INTO `tb_finance_category` VALUES ('2', '采购支出', '0', '0', '2');
INSERT INTO `tb_finance_category` VALUES ('4', '销售收入', '0', '1', '4');
INSERT INTO `tb_finance_category` VALUES ('5', '项目融资', '0', '1', '5');

-- ----------------------------
-- Table structure for tb_member
-- ----------------------------
DROP TABLE IF EXISTS `tb_member`;
CREATE TABLE `tb_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `g_id` int(11) DEFAULT NULL COMMENT '会员分组',
  `card` varchar(255) DEFAULT NULL COMMENT '会员卡号',
  `nickname` varchar(255) DEFAULT NULL COMMENT '会员姓名',
  `sex` int(11) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL COMMENT '电话',
  `qq` varchar(255) DEFAULT NULL COMMENT 'qq',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `id_card` varchar(255) DEFAULT NULL COMMENT '身份证号码',
  `birthday` varchar(20) DEFAULT NULL COMMENT '生日',
  `remark` text COMMENT '备注',
  `create_time` int(11) DEFAULT NULL,
  `points` bigint(20) DEFAULT '0' COMMENT '积分',
  `update` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员';

-- ----------------------------
-- Records of tb_member
-- ----------------------------

-- ----------------------------
-- Table structure for tb_member_card
-- ----------------------------
DROP TABLE IF EXISTS `tb_member_card`;
CREATE TABLE `tb_member_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `card_number` varchar(255) DEFAULT NULL COMMENT '会员卡号',
  `status` int(1) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员卡';

-- ----------------------------
-- Records of tb_member_card
-- ----------------------------

-- ----------------------------
-- Table structure for tb_member_group
-- ----------------------------
DROP TABLE IF EXISTS `tb_member_group`;
CREATE TABLE `tb_member_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  `discounts` double(3,2) DEFAULT '0.00' COMMENT '折扣',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='产器分类';

-- ----------------------------
-- Records of tb_member_group
-- ----------------------------
INSERT INTO `tb_member_group` VALUES ('1', 'VIP1', '0', '0', '0.00');
INSERT INTO `tb_member_group` VALUES ('2', 'VIP2', '0', '0', '0.00');
INSERT INTO `tb_member_group` VALUES ('3', 'VIP3', '0', '0', '0.00');
INSERT INTO `tb_member_group` VALUES ('4', 'VIP4', '0', '0', '0.00');

-- ----------------------------
-- Table structure for tb_member_points
-- ----------------------------
DROP TABLE IF EXISTS `tb_member_points`;
CREATE TABLE `tb_member_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `member` int(11) DEFAULT NULL,
  `m_id` int(11) DEFAULT NULL,
  `type` int(1) DEFAULT '0',
  `create_time` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分日志';

-- ----------------------------
-- Records of tb_member_points
-- ----------------------------

-- ----------------------------
-- Table structure for tb_member_price
-- ----------------------------
DROP TABLE IF EXISTS `tb_member_price`;
CREATE TABLE `tb_member_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) DEFAULT NULL,
  `g_id` int(11) DEFAULT NULL,
  `price` double(20,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_member_price
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate`;
CREATE TABLE `tb_operate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate_1
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate_1`;
CREATE TABLE `tb_operate_1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate_1
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate_10
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate_10`;
CREATE TABLE `tb_operate_10` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate_10
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate_2
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate_2`;
CREATE TABLE `tb_operate_2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate_2
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate_3
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate_3`;
CREATE TABLE `tb_operate_3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate_3
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate_4
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate_4`;
CREATE TABLE `tb_operate_4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate_4
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate_5
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate_5`;
CREATE TABLE `tb_operate_5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate_5
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate_6
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate_6`;
CREATE TABLE `tb_operate_6` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate_6
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate_7
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate_7`;
CREATE TABLE `tb_operate_7` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate_7
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate_8
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate_8`;
CREATE TABLE `tb_operate_8` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate_8
-- ----------------------------

-- ----------------------------
-- Table structure for tb_operate_9
-- ----------------------------
DROP TABLE IF EXISTS `tb_operate_9`;
CREATE TABLE `tb_operate_9` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `client` varchar(15) DEFAULT 'pc' COMMENT '客户端',
  `country` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `data` text,
  `log` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志';

-- ----------------------------
-- Records of tb_operate_9
-- ----------------------------

-- ----------------------------
-- Table structure for tb_pinyin
-- ----------------------------
DROP TABLE IF EXISTS `tb_pinyin`;
CREATE TABLE `tb_pinyin` (
  `py` char(1) NOT NULL,
  `begin` smallint(5) unsigned NOT NULL,
  `end` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`py`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_pinyin
-- ----------------------------
INSERT INTO `tb_pinyin` VALUES ('A', '45217', '45252');
INSERT INTO `tb_pinyin` VALUES ('B', '45253', '45760');
INSERT INTO `tb_pinyin` VALUES ('C', '45761', '46317');
INSERT INTO `tb_pinyin` VALUES ('D', '46318', '46825');
INSERT INTO `tb_pinyin` VALUES ('E', '46826', '47009');
INSERT INTO `tb_pinyin` VALUES ('F', '47010', '47296');
INSERT INTO `tb_pinyin` VALUES ('G', '47297', '47613');
INSERT INTO `tb_pinyin` VALUES ('H', '47614', '48118');
INSERT INTO `tb_pinyin` VALUES ('J', '48119', '49061');
INSERT INTO `tb_pinyin` VALUES ('K', '49062', '49323');
INSERT INTO `tb_pinyin` VALUES ('L', '49324', '49895');
INSERT INTO `tb_pinyin` VALUES ('M', '49896', '50370');
INSERT INTO `tb_pinyin` VALUES ('N', '50371', '50613');
INSERT INTO `tb_pinyin` VALUES ('O', '50614', '50621');
INSERT INTO `tb_pinyin` VALUES ('P', '50622', '50905');
INSERT INTO `tb_pinyin` VALUES ('Q', '50906', '51386');
INSERT INTO `tb_pinyin` VALUES ('R', '51387', '51445');
INSERT INTO `tb_pinyin` VALUES ('S', '51446', '52217');
INSERT INTO `tb_pinyin` VALUES ('T', '52218', '52697');
INSERT INTO `tb_pinyin` VALUES ('W', '52698', '52979');
INSERT INTO `tb_pinyin` VALUES ('X', '52980', '53640');
INSERT INTO `tb_pinyin` VALUES ('Y', '53689', '54480');
INSERT INTO `tb_pinyin` VALUES ('Z', '54481', '55289');

-- ----------------------------
-- Table structure for tb_product
-- ----------------------------
DROP TABLE IF EXISTS `tb_product`;
CREATE TABLE `tb_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL COMMENT '创建员工',
  `c_id` int(11) DEFAULT NULL COMMENT '产品分类',
  `code` varchar(255) DEFAULT NULL COMMENT '产品货号',
  `name` varchar(255) DEFAULT NULL COMMENT '产品名称',
  `image` varchar(255) NOT NULL COMMENT '产品主图',
  `sales` double(11,2) DEFAULT NULL COMMENT '销售价',
  `purchase` double(11,2) DEFAULT NULL COMMENT '进货价',
  `points` bigint(20) DEFAULT '0' COMMENT '积分',
  `format` varchar(255) DEFAULT NULL COMMENT '产品规格',
  `lowest` int(11) DEFAULT '0' COMMENT '最低库存',
  `type` int(1) DEFAULT '0' COMMENT '产品类型',
  `unit` varchar(255) DEFAULT NULL COMMENT '单位',
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `update_uid` int(11) DEFAULT NULL,
  `remark` text COMMENT '备注',
  `bar_code` varchar(100) DEFAULT NULL COMMENT '条码',
  PRIMARY KEY (`id`),
  KEY `uid` (`u_id`),
  KEY `c_id` (`c_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品';

-- ----------------------------
-- Records of tb_product
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_build_order
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_build_order`;
CREATE TABLE `tb_product_build_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(50) NOT NULL COMMENT '生产订单号',
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL COMMENT '生产的产品',
  `quantity` int(11) NOT NULL COMMENT '生产数量 ',
  `build_time` int(11) NOT NULL COMMENT '生产日期',
  `remark` varchar(50) NOT NULL COMMENT '备注',
  `create_time` int(11) NOT NULL COMMENT '创建日期',
  `storage_order_id` int(11) NOT NULL COMMENT '关联的入库订单',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tb_product_build_order
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_build_order_data
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_build_order_data`;
CREATE TABLE `tb_product_build_order_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `o_id` int(11) NOT NULL COMMENT '订单',
  `p_id_bc` int(11) NOT NULL COMMENT '包材名称',
  `w_id` int(11) NOT NULL COMMENT '来自哪个仓库',
  `product_data` text NOT NULL COMMENT '产品快照',
  `quantity` int(11) NOT NULL COMMENT '消耗数量 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tb_product_build_order_data
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_category
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_category`;
CREATE TABLE `tb_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(20) DEFAULT '' COMMENT '分类编号',
  `pid` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='产器分类';

-- ----------------------------
-- Records of tb_product_category
-- ----------------------------
INSERT INTO `tb_product_category` VALUES ('1', '成品', 'CP', '0', '0');
INSERT INTO `tb_product_category` VALUES ('2', '原材', 'YC', '0', '1');

-- ----------------------------
-- Table structure for tb_product_inventory
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_inventory`;
CREATE TABLE `tb_product_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` varchar(255) DEFAULT NULL COMMENT '产品',
  `w_id` varchar(255) DEFAULT NULL COMMENT '仓库',
  `quantity` bigint(255) DEFAULT NULL COMMENT '数量',
  PRIMARY KEY (`id`),
  KEY `product` (`p_id`),
  KEY `warehouse` (`w_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='库存表';

-- ----------------------------
-- Records of tb_product_inventory
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_relation
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_relation`;
CREATE TABLE `tb_product_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `p_id_bc` int(11) NOT NULL,
  `multiple` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tb_product_relation
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_sales_order
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_sales_order`;
CREATE TABLE `tb_product_sales_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(100) DEFAULT NULL COMMENT '订单号',
  `status` int(2) DEFAULT '1' COMMENT '状态',
  `u_id` int(11) DEFAULT NULL COMMENT '创建员工',
  `m_id` int(11) DEFAULT NULL COMMENT '购买会员',
  `create_time` int(11) DEFAULT NULL,
  `remark` text,
  `ship_time` int(11) DEFAULT NULL COMMENT '发货日期',
  `print` int(11) DEFAULT '0' COMMENT '是否打印',
  `amount` double(22,2) DEFAULT NULL COMMENT '金额',
  `points` double(22,2) DEFAULT NULL COMMENT '积分',
  `cost` double(20,2) DEFAULT NULL COMMENT '销售成本',
  `express_id` int(11) DEFAULT NULL COMMENT '快递',
  `express_num` varchar(50) DEFAULT NULL,
  `express_addr` varchar(500) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单管理';

-- ----------------------------
-- Records of tb_product_sales_order
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_sales_order_data
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_sales_order_data`;
CREATE TABLE `tb_product_sales_order_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `o_id` int(11) DEFAULT NULL COMMENT '订单ID',
  `status` int(255) DEFAULT '1' COMMENT '状态',
  `p_id` int(11) DEFAULT NULL COMMENT '产品',
  `quantity` bigint(20) DEFAULT NULL COMMENT '数量',
  `discounts` decimal(4,2) DEFAULT NULL COMMENT '折扣',
  `amount` double(20,2) DEFAULT '0.00' COMMENT '金额',
  `cost` double(20,2) DEFAULT NULL,
  `points` bigint(20) DEFAULT '0' COMMENT '购买积分',
  `w_id` int(11) DEFAULT NULL COMMENT '仓库',
  `product_data` text COMMENT '产品数据',
  `returns` bigint(20) DEFAULT '0' COMMENT '退货数量',
  `group_price` double(20,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `o_id` (`o_id`),
  KEY `warehouse` (`w_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单数据';

-- ----------------------------
-- Records of tb_product_sales_order_data
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_sales_return
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_sales_return`;
CREATE TABLE `tb_product_sales_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL COMMENT '员工',
  `o_id` int(11) DEFAULT NULL COMMENT '订单',
  `create_time` int(11) DEFAULT NULL COMMENT '时间',
  `quantity` bigint(20) DEFAULT NULL COMMENT '退货数量',
  `w_id` int(11) DEFAULT NULL COMMENT '退货仓库',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `uid` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品退货';

-- ----------------------------
-- Records of tb_product_sales_return
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_scrapped
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_scrapped`;
CREATE TABLE `tb_product_scrapped` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL COMMENT '用户',
  `create_time` int(11) DEFAULT NULL,
  `remark` text COMMENT '备注',
  `p_id` bigint(20) DEFAULT NULL,
  `w_id` bigint(20) DEFAULT NULL,
  `quantity` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='报销产品';

-- ----------------------------
-- Records of tb_product_scrapped
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_storage_order
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_storage_order`;
CREATE TABLE `tb_product_storage_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) DEFAULT NULL COMMENT '订单号',
  `u_id` int(11) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `s_id` int(11) DEFAULT NULL COMMENT '供应商',
  `quantity` bigint(20) DEFAULT NULL COMMENT '数量',
  `amount` double(20,2) DEFAULT NULL COMMENT '金额',
  `remark` text,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_product_storage_order
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_storage_order_data
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_storage_order_data`;
CREATE TABLE `tb_product_storage_order_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `o_id` int(11) DEFAULT NULL,
  `w_id` int(11) DEFAULT '0' COMMENT '仓库',
  `s_id` int(11) DEFAULT NULL COMMENT '供应商',
  `p_id` int(11) DEFAULT '0' COMMENT '产品',
  `quantity` bigint(20) DEFAULT NULL COMMENT '数量',
  `create_time` int(10) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `remark` text COMMENT '备注',
  `returns` bigint(20) DEFAULT '0' COMMENT '退货',
  `product_data` text NOT NULL,
  `amount` double(20,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `o_id` (`o_id`),
  KEY `w_id` (`w_id`),
  KEY `s_id` (`s_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品仓库';

-- ----------------------------
-- Records of tb_product_storage_order_data
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_supplier
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_supplier`;
CREATE TABLE `tb_product_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL COMMENT '供应商',
  `name` varchar(255) DEFAULT NULL COMMENT '联系人',
  `tel` varchar(255) DEFAULT NULL COMMENT '电话',
  `fax` varchar(255) DEFAULT NULL COMMENT '传真',
  `mobile` varchar(255) DEFAULT NULL COMMENT '手机',
  `site` varchar(255) DEFAULT NULL COMMENT '网址',
  `email` varchar(255) DEFAULT NULL COMMENT 'EMAIL',
  `pc` varchar(255) DEFAULT NULL COMMENT '邮编',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `remark` text COMMENT '备注',
  `create_time` int(11) DEFAULT NULL COMMENT '创建日期',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  `replace_uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`u_id`),
  KEY `replace_uid` (`replace_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供应商';

-- ----------------------------
-- Records of tb_product_supplier
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_type
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_type`;
CREATE TABLE `tb_product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tb_product_type
-- ----------------------------
INSERT INTO `tb_product_type` VALUES ('1', '成品');
INSERT INTO `tb_product_type` VALUES ('2', '赠品');
INSERT INTO `tb_product_type` VALUES ('3', '原材');
INSERT INTO `tb_product_type` VALUES ('4', '其他');

-- ----------------------------
-- Table structure for tb_product_unit
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_unit`;
CREATE TABLE `tb_product_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '单位名称',
  `sort` int(11) DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_product_unit
-- ----------------------------
INSERT INTO `tb_product_unit` VALUES ('1', '个', '0');
INSERT INTO `tb_product_unit` VALUES ('2', '瓶', '0');
INSERT INTO `tb_product_unit` VALUES ('3', '箱', '0');
INSERT INTO `tb_product_unit` VALUES ('4', '片', '0');
INSERT INTO `tb_product_unit` VALUES ('5', '盒', '0');
INSERT INTO `tb_product_unit` VALUES ('6', '台', '0');
INSERT INTO `tb_product_unit` VALUES ('7', '张', '0');
INSERT INTO `tb_product_unit` VALUES ('8', '套', '0');

-- ----------------------------
-- Table structure for tb_product_warehouse
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_warehouse`;
CREATE TABLE `tb_product_warehouse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '仓库名称',
  `default` int(1) DEFAULT '0' COMMENT '是否默认仓库',
  `address` varchar(255) DEFAULT NULL COMMENT '仓库地址',
  `remark` text,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='仓库';

-- ----------------------------
-- Records of tb_product_warehouse
-- ----------------------------
INSERT INTO `tb_product_warehouse` VALUES ('1', '原材仓库', '1', '金牛区八宝街', '', null);
INSERT INTO `tb_product_warehouse` VALUES ('2', '成品仓库', '1', '金牛区八宝街', '', null);
INSERT INTO `tb_product_warehouse` VALUES ('3', '退货仓库', '0', '金牛区八宝街', '', null);
INSERT INTO `tb_product_warehouse` VALUES ('4', '其他仓库', '0', '金牛区八宝街', '', null);

-- ----------------------------
-- Table structure for tb_product_warehouse_transfer
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_warehouse_transfer`;
CREATE TABLE `tb_product_warehouse_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `jin_id` int(11) DEFAULT NULL COMMENT '拔入仓库',
  `out_id` int(11) DEFAULT NULL COMMENT '排出仓库',
  `p_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='调拨';

-- ----------------------------
-- Records of tb_product_warehouse_transfer
-- ----------------------------

-- ----------------------------
-- Table structure for tb_product_warehouse_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_product_warehouse_user`;
CREATE TABLE `tb_product_warehouse_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) DEFAULT NULL,
  `w_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='仓库负责人';

-- ----------------------------
-- Records of tb_product_warehouse_user
-- ----------------------------

-- ----------------------------
-- Table structure for tb_session
-- ----------------------------
DROP TABLE IF EXISTS `tb_session`;
CREATE TABLE `tb_session` (
  `session_id` varchar(150) NOT NULL,
  `session_expire` int(11) NOT NULL,
  `session_data` varchar(2000) NOT NULL,
  UNIQUE KEY `session_id` (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tb_session
-- ----------------------------
INSERT INTO `tb_session` VALUES ('think_claffpb0jg550urmrknnlhmal6', '1614505415', 'think|a:1:{s:9:\"user_auth\";a:3:{s:2:\"id\";i:1;s:8:\"username\";s:10:\"superadmin\";s:8:\"nickname\";s:15:\"超级管理员\";}}');

-- ----------------------------
-- Table structure for tb_system_menu
-- ----------------------------
DROP TABLE IF EXISTS `tb_system_menu`;
CREATE TABLE `tb_system_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `path` varchar(50) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `home` varchar(50) DEFAULT NULL,
  `is_dev` int(11) DEFAULT NULL,
  `rules` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of tb_system_menu
-- ----------------------------
INSERT INTO `tb_system_menu` VALUES ('1', '0', '系统首页', '1', '1', '0-1', 'glyphicon glyphicon-home', 'index', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('2', '1', '控制台', '0', '1', '0-1-2', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('3', '2', '首页', '1', '1', '0-1-2-3', '', 'admin/index/main', '', '0', 'admin/admin/listorders,admin/index/index,admin/index/main');
INSERT INTO `tb_system_menu` VALUES ('4', '0', '系统管理', '99', '1', '0-4', 'glyphicon glyphicon-cog', 'system', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('5', '4', '系统设置', '1', '1', '0-4-5', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('6', '5', '菜单管理', '3', '0', '0-4-5-6', '', 'admin/system/menu', '', '0', 'admin/system/menu_rule_bind,admin/system/menu_show,admin/system/menu_hide,admin/system/menu,admin/system/menu_import,admin/system/menu_export,admin/system/menu_add,admin/system/menu_edit,admin/system/menu_delete');
INSERT INTO `tb_system_menu` VALUES ('7', '4', '员工管理', '2', '1', '0-4-7', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('8', '7', '员工管理', '1', '1', '0-4-7-8', '', 'admin/system/user', '', '0', 'admin/system/user,admin/system/user_add,admin/system/user_edit,admin/system/user_password_reset,admin/system/user_delete');
INSERT INTO `tb_system_menu` VALUES ('10', '7', '员工分组', '2', '1', '0-4-7-10', '', 'admin/system/auth_group', '', '0', 'admin/system/auth_group,admin/system/auth_group_add,admin/system/auth_group_edit,admin/system/auth_group_delete');
INSERT INTO `tb_system_menu` VALUES ('12', '0', '库存管理', '30', '1', '0-12', 'glyphicon glyphicon-equalizer', 'inventory', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('14', '12', '库存管理', '3', '1', '0-12-14', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('15', '14', '库存查询', '1', '1', '0-12-14-15', '', 'admin/inventory/stock_query', '', '0', 'admin/configure/product_look,admin/inventory/stock_query,admin/inventory/transfer_add');
INSERT INTO `tb_system_menu` VALUES ('17', '12', '入库管理', '1', '1', '0-12-17', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('18', '17', '入库查询', '2', '1', '0-12-17-18', '', 'admin/inventory/storage_query', '', '0', 'admin/inventory/storage_undo,admin/inventory/storage_query');
INSERT INTO `tb_system_menu` VALUES ('20', '17', '入库', '1', '1', '0-12-17-20', '', 'admin/inventory/storage', '', '0', 'admin/inventory/storage,admin/inventory/storage_submit,admin/json/product');
INSERT INTO `tb_system_menu` VALUES ('28', '57', '产品管理', '6', '1', '0-42-57-28', '', 'admin/configure/product', '', '0', 'admin/configure/product_look,admin/configure/product,admin/configure/product_add,admin/configure/product_edit,admin/configure/product_del,admin/res/index,admin/res/index_upload,admin/res/index_delete,admin/res/index_folder,admin/res/clear');
INSERT INTO `tb_system_menu` VALUES ('29', '14', '调拨查询', '4', '1', '0-12-14-29', '', 'admin/inventory/transfer_query', '', '0', 'admin/inventory/transfer_query');
INSERT INTO `tb_system_menu` VALUES ('31', '12', '出库管理', '2', '1', '0-12-31', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('32', '31', '出库', '1', '1', '0-12-31-32', '', 'admin/inventory/sales', '', '0', 'admin/inventory/sales,admin/inventory/sales_submit,admin/json/product,admin/json/member');
INSERT INTO `tb_system_menu` VALUES ('33', '31', '出库查询', '2', '1', '0-12-31-33', '', 'admin/inventory/sales_query', '', '0', 'admin/inventory/sales_query,admin/inventory/sales_undo');
INSERT INTO `tb_system_menu` VALUES ('35', '31', '退货查询', '4', '1', '0-12-31-35', '', 'admin/inventory/sales_returns_query', '', '0', 'admin/inventory/sales_returns_query,admin/inventory/sales_returns_add,admin/inventory/sales_look,admin/inventory/sales_look_info_update');
INSERT INTO `tb_system_menu` VALUES ('37', '14', '报废查询', '6', '1', '0-12-14-37', '', 'admin/inventory/scrapped_query', '', '0', 'admin/inventory/scrapped_add,admin/inventory/scrapped_query');
INSERT INTO `tb_system_menu` VALUES ('38', '42', '库存设置', '1', '1', '0-42-38', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('39', '57', '产品分类', '1', '1', '0-42-57-39', '', 'admin/configure/product_category', '', '0', 'admin/configure/product_category,admin/configure/product_category_add,admin/configure/product_category_delete,admin/configure/product_category_edit');
INSERT INTO `tb_system_menu` VALUES ('40', '38', '仓库管理', '2', '1', '0-4-38-40', '', 'admin/configure/warehouse', '', '0', 'admin/configure/warehouse,admin/configure/warehouse_add,admin/configure/warehouse_edit,admin/configure/warehouse_delete');
INSERT INTO `tb_system_menu` VALUES ('41', '38', '计量单位', '3', '1', '0-4-38-41', '', 'admin/configure/unit', '', '0', 'admin/configure/unit,admin/configure/unit_add,admin/configure/unit_edit,admin/configure/unit_delete');
INSERT INTO `tb_system_menu` VALUES ('42', '0', '库存配置', '40', '1', '0-42', 'glyphicon glyphicon-tasks', 'configure', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('43', '42', '会员管理', '3', '1', '0-42-43', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('44', '43', '会员组', '2', '0', '0-42-43-44', '', 'admin/member/group', '', '0', 'admin/member/group_price,admin/member/group,admin/member/group_add,admin/member/group_edit,admin/member/group_delete');
INSERT INTO `tb_system_menu` VALUES ('45', '43', '会员列表', '3', '1', '0-42-43-45', '', 'admin/member/index', '', '0', 'admin/member/index,admin/member/delete,admin/member/look,admin/member/edit,admin/member/add');
INSERT INTO `tb_system_menu` VALUES ('48', '38', '供应商', '0', '1', '0-42-47-48', '', 'admin/configure/supplier', '', '0', 'admin/configure/supplier,admin/configure/supplier_add,admin/configure/supplier_edit,admin/configure/supplier_look,admin/configure/supplier_delete');
INSERT INTO `tb_system_menu` VALUES ('52', '2', '我的日志', '2', '1', '0-1-2-52', '', 'admin/index/log', '', '0', 'admin/index/log_clear,admin/index/password,admin/index/log');
INSERT INTO `tb_system_menu` VALUES ('53', '38', '快递管理', '4', '0', '0-42-38-53', '', 'admin/configure/express', '', '0', 'admin/configure/express,admin/configure/express_add,admin/configure/express_edit,admin/configure/express_delete');
INSERT INTO `tb_system_menu` VALUES ('57', '42', '产品管理', '2', '1', '0-42-57', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('59', '5', '系统参数', '0', '1', '0-4-5-59', '', 'admin/system/config', '', '0', 'admin/system/config');
INSERT INTO `tb_system_menu` VALUES ('60', '4', '数据库', '3', '0', '0-4-60', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('61', '60', '数据备份', '1', '0', '0-4-60-61', '', 'admin/database/export_list', '', '0', 'admin/database/export,admin/database/export_list,admin/database/optimize,admin/database/repair');
INSERT INTO `tb_system_menu` VALUES ('62', '60', '数据还原', '2', '0', '0-4-60-62', '', 'admin/database/import_list', '', '0', 'admin/database/import_list,admin/database/del,admin/database/import');
INSERT INTO `tb_system_menu` VALUES ('63', '0', '财务管理', '60', '0', '0-63', 'glyphicon glyphicon-usd', 'finance', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('65', '67', '银行列表', '4', '0', '0-63-64-65', '', 'admin/finance/bank', '', '0', 'admin/finance/bank,admin/finance/bank_add,admin/finance/bank_delete,admin/finance/bank_edit');
INSERT INTO `tb_system_menu` VALUES ('67', '63', '财务', '1', '0', '0-63-67', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('68', '67', '财务分类', '3', '0', '0-63-67-68', '', 'admin/finance/category', '', '0', 'admin/finance/category,admin/finance/category_add,admin/finance/category_edit,admin/finance/category_delete');
INSERT INTO `tb_system_menu` VALUES ('70', '67', '账务查询', '2', '0', '0-63-67-70', '', 'admin/finance/query', '', '0', 'admin/finance/query,admin/finance/query_delete,admin/json/finance_category');
INSERT INTO `tb_system_menu` VALUES ('71', '67', '新增财务', '1', '0', '0-63-67-71', '', 'admin/finance/add', '', '0', 'admin/finance/add,admin/json/finance_category');
INSERT INTO `tb_system_menu` VALUES ('76', '80', '包材关联', '3', '0', '0-79-80-76', '', 'admin/production/product_relation', '', '0', 'admin/production/product_relation,admin/production/product_relation_edit,admin/production/product_relation_edit_submit');
INSERT INTO `tb_system_menu` VALUES ('77', '80', '加工', '1', '0', '0-79-80-77', '', 'admin/production/product_build', '', '0', 'admin/json/product,admin/production/product_build_submit,admin/production/product_build');
INSERT INTO `tb_system_menu` VALUES ('78', '80', '加工记录', '2', '0', '0-79-80-78', '', 'admin/production/product_build_query', '', '0', 'admin/production/product_build_undo,admin/production/product_build_query');
INSERT INTO `tb_system_menu` VALUES ('79', '0', '生产管理', '2', '0', '0-79', 'glyphicon glyphicon-scissors', 'production', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('80', '79', ' 生产', '20', '0', '0-79-80', '', '', '', '0', null);
INSERT INTO `tb_system_menu` VALUES ('82', '0', '统计报表', '90', '1', '0-82', 'glyphicon glyphicon-signal', 'statistics', null, null, null);
INSERT INTO `tb_system_menu` VALUES ('83', '82', '仓库', '0', '1', null, '', '', null, null, null);
INSERT INTO `tb_system_menu` VALUES ('84', '83', '出库报表', '0', '1', null, '', 'admin/statistics/sales', null, null, 'admin/statistics/sales');
INSERT INTO `tb_system_menu` VALUES ('85', '83', '入库报表', '0', '1', null, '', 'admin/statistics/storage', null, null, 'admin/statistics/storage');
INSERT INTO `tb_system_menu` VALUES ('86', '5', '系统附件', '86', '0', '0-4-5-86', '', 'admin/res/index', null, null, 'admin/res/index,admin/res/index_upload,admin/res/index_delete,admin/res/index_folder,admin/res/clear');
INSERT INTO `tb_system_menu` VALUES ('87', '82', '财务', '87', '0', '0-82-87', '', '', null, null, null);
INSERT INTO `tb_system_menu` VALUES ('88', '87', '财务统计', '88', '0', '0-82-87-88', '', 'admin/statistics/finance', null, null, 'admin/statistics/finance');
INSERT INTO `tb_system_menu` VALUES ('89', '57', '产品类型', '89', '1', '0-42-57-89', '', 'admin/configure/product_type', null, null, 'admin/configure/product_type,admin/configure/product_type_add,admin/configure/product_type_field,admin/configure/product_type_del');

-- ----------------------------
-- Table structure for tb_system_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_system_user`;
CREATE TABLE `tb_system_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `birthday` varchar(11) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_system_user
-- ----------------------------
INSERT INTO `tb_system_user` VALUES ('1', 'superadmin', '超级管理员', '9fcf39561d43c6ff444abf3398d9d930', null, null, '1', null, null, null, null);
