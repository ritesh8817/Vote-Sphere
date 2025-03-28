'use client';

import { useState, useEffect } from 'react';
import ProfileCard from './ProfileCard';
import EditProfileForm from './EditProfileForm';
import './ProfilePage.css';

const ProfilePage = () => {
  const [userId, setUserId] = useState(1);
  const [displayId, setDisplayId] = useState(1);
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);
  const [isEditing, setIsEditing] = useState(false);

  const baseUrl = process.env.REACT_APP_API_BASE_URL || "http://localhost:5000/api";

  useEffect(() => {
    const fetchUser = async () => {
      setLoading(true);
      setError(null);
      try {
        const response = await fetch(`${baseUrl}/user/${userId}`);
        if (!response.ok) throw new Error(`Error: ${response.status} ${response.statusText}`);
        const userData = await response.json();
        setUser(userData);
      } catch (err) {
        console.error('Failed to fetch user data:', err);
        setError(err.message);
        setUser(null);
      } finally {
        setLoading(false);
      }
    };

    fetchUser();
  }, [userId]);

  const handleSave = async (updatedUser) => {
    setLoading(true);
    setError(null);
    try {
      const response = await fetch(`${baseUrl}/user/${displayId}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(updatedUser),
      });
      if (!response.ok) throw new Error('Failed to update profile');
      const updatedData = await response.json();
      setUser(updatedData);
      setIsEditing(false);
    } catch (err) {
      console.error('Failed to update user data:', err);
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  const handleCancel = () => setIsEditing(false);

  const handleUserIdChange = (e) => {
    const selectedId = Number(e.target.value);
    setDisplayId(selectedId);
    setUserId(selectedId);
    setIsEditing(false);
  };

  return (
    <div className="container">
      <h1>User Profile</h1>
      <div className="selector">
        <label htmlFor="userId">Select User ID:</label>
        <select id="userId" value={displayId} onChange={handleUserIdChange}>
          <option value={1}>1</option>
          <option value={2}>2</option>
          <option value={3}>3</option>
        </select>
      </div>
      {loading && <p>Loading user data...</p>}
      {error && <p className="error">Error: {error}</p>}
      {user && !isEditing && <ProfileCard user={user} onEdit={() => setIsEditing(true)} />}
      {isEditing && user && <EditProfileForm user={user} onSave={handleSave} onCancel={handleCancel} />}
    </div>
  );
};

export default ProfilePage;
