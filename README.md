# DazBet - Game Match Betting Service

## Overview
DazBet is a lightweight betting service that allows friends to bet on the outcome of computer game matches, adding more excitement to spectating. Built with PHP, Vanilla JS, and SQLite, the service runs in a Docker container for easy deployment.

## Features

- **Betting**: Can't bet on oneself.
- **Referees**: Three secret referees chosen randomly.
- **Versatility**: Support for various match types (1v1, 2v2, etc).
- **Currency**: DazCoins used for betting.
- **Odds**: Dynamic odds based on past performance and live bets.
- **Leaderboard**: Track earnings and odds.
- **Notifications**: Instant updates on odds.
- **Betting Options**: Double-or-nothing available.
- **Dynamic Limits**: Max bet is 75% of held DazCoins.
- **Login**: Quick and simple.
- **Metrics**: Track wins, losses, matches, and lifetime DazCoin stats. Tips for average bet size and win streaks included.

## Tech Stack

- **Backend**: PHP
- **Frontend**: Vanilla JavaScript
- **Database**: SQLite
- **Server**: NGINX (via NGINX Proxy Manager)
- **Containerisation**: Docker

## Installation

1. Clone this repository.
2. Build the Docker container.
3. Deploy via NGINX Proxy Manager.

## Usage

- Run the Docker container.
- Access via the web browser.

## Contributing

Feel free to submit pull requests or open issues.
