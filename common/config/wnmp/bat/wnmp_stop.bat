cd nginx-1.7.3
taskkill /F /IM nginx.exe
cd ..
taskkill /F /IM php-cgi.exe
NET STOP MongoDB
pause