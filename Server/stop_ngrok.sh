#!/bin/bash

PID="$(pidof ngrok)"

echo Se detendrá el proceso ngrok con pid: $PID

if [ -z "$PID" ]
then
	echo Programa no ejecutado
else
	kill $PID
	echo Programa detenido
fi
