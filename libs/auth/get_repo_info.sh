#!/bin/bash

# gh_result=$(gh repo view --json)
# echo "gh_result: ${gh_result}"

# repo_info=$(echo $gh_result | jq '. | {name: .name, description: .description, default_branch: .defaultBranchRef.name, license: .licenseInfo.spdxId, languages: .languages.nodes[].name, last_updated: .updatedAt}')
# echo "repo_info: ${repo_info}"

# gh repo view --json name,description,defaultBranchRef,licenseInfo,languages,updatedAt --jq '. | {name: .name, description: .description, default_branch: .defaultBranchRef.name, license: .licenseInfo.spdxId, languages: .languages.nodes[].name, last_updated: .updatedAt}'
# gh repo view --json name,description,defaultBranchRef,licenseInfo,languages,updatedAt --jq '{name, description, default_branch: .defaultBranchRef.name, license: .licenseInfo.spdxId, languages: [.languages.nodes[].name | tostring] | join(", "), last_updated: .updatedAt}'
# gh repo view --json name,description,defaultBranchRef,licenseInfo,languages,updatedAt

gh repo view --json name,description,defaultBranchRef,licenseInfo,languages,updatedAt --jq '{name}'
