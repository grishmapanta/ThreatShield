import requests

def log(message, level="info"):
    """Log messages with a specified severity level."""
    print(f"[{level.upper()}] {message}")

def send_post(url, data=None, headers=None, cookies=None):
    """Send a POST request."""
    return requests.post(url, data=data, headers=headers, cookies=cookies)

def send_get(url, headers=None, cookies=None):
    """Send a GET request."""
    return requests.get(url, headers=headers, cookies=cookies)
