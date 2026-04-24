@echo off
set GIT=C:\laragon\bin\git\bin\git.exe

%GIT% config user.email "nizzarsmkn1sby@github.com"
%GIT% config user.name "nizzarsmkn1sby"
%GIT% commit -m "update: master category CRUD, dashboard charts, POS category filter"
%GIT% remote add origin https://github.com/nizzarsmkn1sby/bonda.git
%GIT% branch -M main
%GIT% push -u origin main
echo Done!
