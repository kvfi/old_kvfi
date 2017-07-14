from skeleton.database import db_session
from skeleton.models import Entry


entry = Entry.query.filter(Entry.path == 'About').first()
print(entry.privacy_id)
