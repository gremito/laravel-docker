# test_zipcloud_request.py
import subprocess
import json
import pytest

def test_zipcloud_request():
    script_path = "./get_postal_service_info.sh 1500001"
    
    result = subprocess.run([script_path], capture_output=True, text=True)
    
    output = result.stdout.strip()
    response_data = json.loads(output)
    
    assert response_data["results"][0]["address2"] == "渋谷区"

if __name__ == "__main__":
    pytest.main()
