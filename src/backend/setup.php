<?php
// Open or create the SQLite database
$db = new SQLite3('/path/to/main.db');

// Execute SQL queries to create tables
$db->exec('CREATE TABLE IF NOT EXISTS Users (
    UserID INTEGER PRIMARY KEY AUTOINCREMENT,
    Username TEXT NOT NULL,
    Password TEXT NOT NULL,
    DazCoins INTEGER DEFAULT 100,
    Wins INTEGER DEFAULT 0,
    Losses INTEGER DEFAULT 0,
    MatchesPlayed INTEGER DEFAULT 0
)');

$db->exec('CREATE TABLE IF NOT EXISTS Matches (
    MatchID INTEGER PRIMARY KEY AUTOINCREMENT,
    Status TEXT NOT NULL DEFAULT "Ongoing",
    WinnerTeam TEXT
)');

$db->exec('CREATE TABLE IF NOT EXISTS Bets (
    BetID INTEGER PRIMARY KEY AUTOINCREMENT,
    MatchID INTEGER,
    UserID INTEGER,
    BetAmount INTEGER,
    ChosenWinnerTeam TEXT,
    FOREIGN KEY (MatchID) REFERENCES Matches(MatchID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
)');

$db->exec('CREATE TABLE IF NOT EXISTS Referees (
    RefereeID INTEGER PRIMARY KEY AUTOINCREMENT,
    MatchID INTEGER,
    UserID INTEGER,
    TeamDecision TEXT,
    FOREIGN KEY (MatchID) REFERENCES Matches(MatchID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
)');

$db->exec('CREATE TABLE IF NOT EXISTS PlayersInMatches (
    RecordID INTEGER PRIMARY KEY AUTOINCREMENT,
    MatchID INTEGER,
    UserID INTEGER,
    Team TEXT,
    FOREIGN KEY (MatchID) REFERENCES Matches(MatchID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
)');

echo "Tables created successfully.";

?>
