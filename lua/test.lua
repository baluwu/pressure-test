
local mysql = require("resty.mysql")

--创建实例
local db, err = mysql:new()
if not db then
    ngx.say("new mysql error : ", err)
    return
end
--设置超时时间(毫秒)
db:set_timeout(1000)

local props = {
    host = "",
    port = "",
    database = "",
    user = "",
    password = "";
}

local res, err, errno, sqlstate = db:connect(props)

if not res then
   ngx.say("connect to mysql error : ", err, " , errno : ", errno, " , sqlstate : ", sqlstate)
   return 
end

--查询
local select_sql = 'SELECT SQL_NO_CACHE a.order_id FROM `order` a WHERE a.order_status = 0 AND a.delivery_status = 0 LIMIT 10'
res, err, errno, sqlstate = db:query(select_sql)
if not res then
   ngx.say("select error : ", err, " , errno : ", errno, " , sqlstate : ", sqlstate)
   return 
end

for i, row in ipairs(res) do
   for name, value in pairs(row) do
     ngx.say("select row ", i, " : ", name, " = ", value)
   end
end

db:set_keepalive(30000, 100)
