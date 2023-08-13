#!/bin/bash
set -x
while [ "$#" -gt 0 ]; do
  case "$1" in

    --p=*)
      P="P${1#*=}"
      ;;
    --m=*)
      M="${1#*=}"
      ;;
    --game=*)
      GAME="${1#*=}"
      ;;
    *)
      echo "Unknown parameter: $1"
      exit 1
      ;;
  esac
  shift
done

# You can provide default values if needed

: ${P:="hou"}
: ${M:="3"}
: ${GAME:="0"}

DIRECTORY="/Applications/XAMPP/htdocs/responses/$P"
RESPONSES="/Applications/XAMPP/htdocs/responses"
FILENAME="${P}_m${M}_g${GAME}.mp4"
echo "directory"$DIRECTORY
# Check and create the directory
if [ ! -d "$DIRECTORY" ]; then
  mkdir -p "$DIRECTORY" || { echo "Failed to create directory: $DIRECTORY"; exit 1; }
  chmod 755 "$DIRECTORY" || { echo "Failed to set permissions on directory: $DIRECTORY"; exit 1; }

fi

# SCP the file
scp -r "app@172.29.41.14:/home/app/catkin_ws/src/multiplayer_space_invaders/participant_videos/$P/$FILENAME" "$DIRECTORY/" || { echo "Failed to copy file from remote server"; exit 1; }

# Copy the file to the videos directory
cp "$DIRECTORY/$FILENAME" "/Applications/XAMPP/htdocs/videos" || { echo "Failed to copy file to videos directory"; exit 1; }

echo "File copied successfully"



# bash copy_video.sh --p="hou" --m="3" --game="0"
