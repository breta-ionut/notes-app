# Notes app

A Vue + Symfony sample application for managing one's notes.

## Prerequisites

1. Git
2. Docker

## Installation

1. Run `make init`
2. Add `127.0.0.1 notes.local` to your hosts file (`/etc/hosts` on Ubuntu or other UNIX-based OS)

## Usage

1. The app should be available at https://notes.local
2. The API documentation should be available at https://notes.local/api/doc
3. For creating a user, run `make user-register <username>` where `<username>` should get replaced with your desired 
   username. Follow the instructions from that point on. You will be able to use that user for logging in the app
