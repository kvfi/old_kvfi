from sqlalchemy import Column, Integer, String
from skeleton.database import Base


class Entry(Base):
    __tablename__ = 'entry'
    id = Column(Integer, primary_key=True)
    path = Column(String(50), unique=True)
    privacy_id = Column(Integer)

    def __init__(self, pid=None, path=None, privacy_id=None):
        self.pid = pid
        self.path = path
        self.privacy_id = privacy_id


class EntryPolicy(Base):
    __tablename__ = 'entry_policy'
    id = Column(Integer, primary_key=True)
    created_on = Column(String(200))
    code = Column(String(200))
    access_count = Column(Integer)

    def __init__(self, id=None, created_on=None, code=None, access_count=None):
        self.id = id
        self.created_on = created_on
        self.code = code
        self.access_count = access_count
