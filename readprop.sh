#!/bin/bash

# lockfile-create /dev/shm/readpropsh_$BACNET_BBMD_ADDRESS
./bin/bacrpm $*
# lockfile-remove /dev/shm/readpropsh_$BACNET_BBMD_ADDRESS

