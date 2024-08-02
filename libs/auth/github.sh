#!/bin/bash

# GitHub Personal Access Token
GITHUB_TOKEN="your_personal_access_token_here"

# GitHub API URL
GITHUB_API_URL="https://api.github.com/user"

# Make an authenticated API request
response=$(curl -s -H "Authorization: token $GITHUB_TOKEN" $GITHUB_API_URL)

# Check if the response contains the login field
if echo "$response" | grep -q '"login"'; then
  echo "Authentication successful!"
  echo "Response:"
  echo "$response" | jq
else
  echo "Authentication failed!"
  echo "Response:"
  echo "$response"
fi
