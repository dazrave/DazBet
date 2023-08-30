<?php
// Open or create the SQLite database
include 'db_connection.php';

// Drop existing tables
$db->exec('DROP TABLE IF EXISTS PlayersInMatches');
$db->exec('DROP TABLE IF EXISTS Referees');
$db->exec('DROP TABLE IF EXISTS Bets');
$db->exec('DROP TABLE IF EXISTS Matches');
$db->exec('DROP TABLE IF EXISTS Users');

// Execute SQL queries to create tables
$db->exec('CREATE TABLE IF NOT EXISTS Users (
    UserID INTEGER PRIMARY KEY AUTOINCREMENT,
    Username TEXT NOT NULL UNIQUE,
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

// Hash default password
$hashed_password = password_hash('Delta123', PASSWORD_DEFAULT);

// Insert default user
$db->exec("INSERT OR IGNORE INTO Users (Username, Password) VALUES ('DazRave', '$hashed_password')");

echo "Tables dropped and recreated successfully.";

// Insert test users
$testUsers = [
    ['username' => 'User1', 'password' => 'Test123'],
    ['username' => 'User2', 'password' => 'Test123'],
    ['username' => 'User3', 'password' => 'Test123'],
    // ... add more test users if needed
];

foreach ($testUsers as $user) {
    $username = $user['username'];
    $password = password_hash($user['password'], PASSWORD_DEFAULT);

    // Insert user into the database
    $stmt = $db->prepare('INSERT INTO Users (Username, Password) VALUES (:username, :password)');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $stmt->execute();
}

echo "Test users inserted successfully.";
?>
