import subprocess
import json
import pytest

def test_auth_request():
    script_path = "./get_repo_info.sh"
    
    result = subprocess.run([script_path], capture_output=True, text=True)
    
    output = result.stdout.strip()
    response_data = json.loads(output)
    
    assert "data" in response_data
    assert response_data["name"] == "docker-for-laravel"

if __name__ == "__main__":
    pytest.main()
