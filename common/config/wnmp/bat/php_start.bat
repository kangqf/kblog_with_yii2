@echo off
if "%1" == "h" goto begin
mshta vbscript:createobject("wscript.shell").run("""%~nx0"" h",0)(window.close)&&exit
:begin
REM
cd php5.5.15
php-cgi.exe -b 127.0.0.1:9000
cd ..

cd nginx-1.7.3
nginx.exe
cd ..