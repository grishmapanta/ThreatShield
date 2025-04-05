
# backend/mitre_mapper.py

MITRE_TECHNIQUES = {
    "T1110.001": {
        "tactic": "Credential Access",
        "technique": "Password Guessing",
        "url": "https://attack.mitre.org/techniques/T1110/001/"
    },
    "T1059.007": {
        "tactic": "Execution",
        "technique": "JavaScript",
        "url": "https://attack.mitre.org/techniques/T1059/007/"
    },
    "T1068": {
        "tactic": "Privilege Escalation",
        "technique": "Exploitation for Privilege Escalation",
        "url": "https://attack.mitre.org/techniques/T1068/"
    },
    "T1505.003": {
        "tactic": "Persistence",
        "technique": "SQL Stored Procedures",
        "url": "https://attack.mitre.org/techniques/T1505/003/"
    }
}

def map_to_mitre(technique_id):
    """Map a technique ID to its MITRE ATT&CK details."""
    return MITRE_TECHNIQUES.get(technique_id, {
        "tactic": "Unknown",
        "technique": "Unknown Technique",
        "url": "#"
    })

