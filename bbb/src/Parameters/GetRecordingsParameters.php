<?php
/**
 * BigBlueButton open source conferencing system - http://www.bigbluebutton.org/.
 *
 * Copyright (c) 2016 BigBlueButton Inc. and by respective authors (see below).
 *
 * This program is free software; you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation; either version 3.0 of the License, or (at your option) any later
 * version.
 *
 * BigBlueButton is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE. See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with BigBlueButton; if not, see <http://www.gnu.org/licenses/>.
 */
namespace BigBlueButton\Parameters;

/**
 * Class GetRecordingsParameters
 * @package BigBlueButton\Parameters
 */
class GetRecordingsParameters extends BaseParameters
{
    /**
     * @var string
     */
    private $meetingId;
    private $state;

    /**
     * GetRecordingsParameters constructor.
     *
     * @param $meetingId
     */
    public function __construct($meetingId)
    {
        $this->meetingId = $meetingId;
    }

    /**
     * @return string
     */
    public function getMeetingId()
    {
        return $this->meetingId;
    }

    /**
     * @param  string                  $meetingId
     * @return GetRecordingsParameters
     */

	public function setMeetingId($meetingId)
    {
        $this->meetingId = $meetingId;

        return $this;
    }

	public function setState($state)
    {
        $this->state = $state;

        return $this;
    }


    /**
     * @return string
     */
    public function getHTTPQuery()
    {
        return $this->buildHTTPQuery(['meetingID' => $this->meetingId,'state' => $this->state]);
    }
}
