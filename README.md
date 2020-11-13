# Introduction

This is a simple PoC to play with a Philips Hue Bridge using its API with a simple Symfony CLI outside of the framework.

# Documentation

## To list the devices

```
$ ./hue device:list --help
Description:
  Lists the available lights with their status.

Usage:
  device:list
```

## To switch the device on or off

```
$ ./hue device:switch --help
Description:
  Turns the given device on or off.

Usage:
  device:switch [options] [--] <deviceId>

Arguments:
  deviceId              The id of the device.

Options:
      --on              If the device should be on.
      --off             If the device should be off.
```

# Usage

## To list the devices

```
$ ./hue device:list

Your lights :
=============

 ---- ------------ --------
  Id   Name         Status 
 ---- ------------ --------
  6    Bedroom      on
  7    Livingroom   on
  8    Bathroom     off
  9    Hall         off
  10   Kitchen      off
 ---- ------------ --------

```

## To switch the device off

```
$ ./hue device:switch 10 --off

                                                                                                                        
 [OK] Device #10 has been turned off                                                                                    
                                                                                                                        

```
