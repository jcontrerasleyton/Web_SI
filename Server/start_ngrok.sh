#!/bin/bash

#Validar que el programa no se encuentra en ejecución
PID="$(pidof ngrok)"

if [ -z "$PID" ]
then
	#Eliminar Archivos Anteriores
	rm Log/*
	rm nohup.out

	#Iniciar Tunnel
	nohup ./ngrok http 80 &

	#Esperar
	sleep 3

	#Obtener PID
	ps aux | grep ngrok > Log/pid.txt

	#Obtener IP
	python server.py	
else
	echo Programa ya ejecutado PID: $PID
fi



