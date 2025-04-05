import json
import importlib.util
import os
from backend.mitre_mapper import map_to_mitre
from backend.report_generator import generate_report
from backend.utility_f import log

def load_module(module_name):
    """Dynamically load an attack module."""
    module_path = os.path.join(os.path.dirname(__file__), '..', 'attacks', f"{module_name}.py")
    spec = importlib.util.spec_from_file_location(module_name, module_path)
    module = importlib.util.module_from_spec(spec)
    spec.loader.exec_module(module)
    return module

def run_playbook(playbook_path):
    """Execute the attack playbook."""
    with open(playbook_path, 'r') as file:
        playbook = json.load(file)

    results = []
    for step in playbook["stages"]:
        module_name = step["module"]
        target_url = step["target_url"]
        log(f"Running module: {module_name} on {target_url}")

        try:
            module = load_module(module_name)
            result = module.run(target_url)
            result["mitre"] = map_to_mitre(result["technique_id"])
            results.append(result)
        except FileNotFoundError:
            log(f"Module {module_name} not found.", level="error")
        except Exception as e:
            log(f"Error executing module {module_name}: {str(e)}", level="error")

    generate_report(results)
    return results

