import os
import pdfkit
from jinja2 import Environment, FileSystemLoader
from datetime import datetime
from collections import defaultdict

def generate_report(results, report_name=None):
    # Group results by tactic (stage)
    grouped = defaultdict(list)
    for res in results:
        grouped[res["stage"]].append(res)

    # Count summary stats
    success_count = sum(1 for r in results if r["success"])
    fail_count = len(results) - success_count

    # Setup templating
    env = Environment(loader=FileSystemLoader('templates'))
    template = env.get_template('report_template.html')

    now = datetime.now()
    timestamp = now.strftime('%Y-%m-%d_%H-%M')
    report_name = report_name or f'RedTeam_Report_{timestamp}'

    # Render template
    html_output = template.render(
        title="Red Team Simulation Report",
        date=now.strftime("%Y-%m-%d %H:%M"),
        grouped_results=grouped,
        total=len(results),
        success=success_count,
        failed=fail_count
    )

    # Ensure output folder
    if not os.path.exists("reports"):
        os.makedirs("reports")

    html_path = os.path.join("reports", f"{report_name}.html")
    pdf_path = os.path.join("reports", f"{report_name}.pdf")

    # Write HTML
    with open(html_path, "w", encoding="utf-8") as f:
        f.write(html_output)

    # Convert to PDF
    pdfkit.from_file(html_path, pdf_path)

    print(f"[+] PDF report generated at: {pdf_path}")
