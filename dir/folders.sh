#!/bin/bash

#MAIN_PATH='/var/www/html/jobscrapperv2/jobscrapperv2/dir';
#MOV_PATH='/var/www/html/jobscrapperv2/jobscrapperv2/';

if [ "$#" -ne 2 ];then
 echo "Please pass project path and path to move 'Agency' folder"
 exit 0 
fi   

PROJECT_PATH="$1";
MOV_FOLDER_PATH="$2"; 

folder_list=`ls $PROJECT_PATH`;
find_folder=agency; 
if [ !  -d "$MOV_FOLDER_PATH/TODEL" ]
then
	mkdir "$MOV_FOLDER_PATH/TODEL"
fi

if [ ! -d "$PROJECT_PATH/UPLOAD" ] 
then
	mkdir "$PROJECT_PATH/UPLOAD"
fi

OIFS=$IFS;
for dirname in  $folder_list ;do
        #echo $dirname
	for  output in `find $PROJECT_PATH/$dirname -type d -iname "$find_folder" `; do
		temp_o=$output;
                IFS='/';
		read -r -a proj_name <<< "$temp_o";
		IFS=$OIFS;
		#echo $MOV_PATH/TODEL/${proj_name[0]}-agent;
		#cp -r  $output $MOV_FOLDER_PATH/TODEL/"${proj_name[0]}-$find_folder"
                mv $output $MOV_FOLDER_PATH/TODEL/"${proj_name[0]}-$find_folder" 
		#echo $output;
                echo  "$output Moved."
	done
done
#cp -r "$PROJECT_PATH" "$PROJECT_PATH/UPLOAD/";
